<?php
include 'components/connect.php';
session_start();

// ✅ Require user login
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $repair_type = filter_var($_POST['repair_type'], FILTER_SANITIZE_STRING);
    $repair_details = filter_var($_POST['repair_details'], FILTER_SANITIZE_STRING);
    $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);

    // ✅ Ensure user exists
    $check_user = $conn->prepare("SELECT id FROM users WHERE id = ?");
    $check_user->execute([$user_id]);
    if ($check_user->rowCount() == 0) {
        die("⚠️ Invalid user. Please log in again.");
    }

    $insert_repair = $conn->prepare("INSERT INTO `repairs`
        (user_id, phone, repair_type, repair_details, location, admin_status, servicer_status) 
        VALUES (?,?,?,?,?,?,?)");
    $insert_repair->execute([$user_id, $phone, $repair_type, $repair_details, $location, 'pending', 'pending']);

    $message[] = '✅ Repair request submitted. Waiting for admin approval.';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $delete_repair = $conn->prepare("DELETE FROM `repairs` WHERE id = ?");
    $delete_repair->execute([$delete_id]);

    $message[] = '🗑️ Repair request deleted successfully!';
    header('location:repair_ser.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Repair Request</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
   <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
<?php include 'components/user_header.php'; ?>

<section class="ask_repair">
   <h1 class="heading">Request Computer Repair</h1>
   <div class="box-container">
<form action="" method="POST" onsubmit="return validateRepairForm()">
    <div class="flex">

        <div class="inputBox">
            <label>Name:</label>
            <input type="text" class="box" name="name" placeholder="Enter your name" required>
        </div>

        <div class="inputBox">
            <label>Phone:</label>
            <input type="number" class="box" name="phone" placeholder="Enter your phone number" required>
        </div>

        <div class="inputBox">
            <label>Repair Type:</label>
            <select name="repair_type" class="box">
                <option>Laptop</option>
                <option>Desktop</option>
                <option>Monitor</option>
                <option>Other</option>
            </select>
        </div>

        <div class="inputBox">
            <label>Repair Details:</label>
            <textarea name="repair_details" class="box" placeholder="Enter the repair details" required></textarea>
        </div>

        <div class="inputBox">
            <label>Repair Location:</label>
            <input type="text" class="box" id="location" name="location" placeholder="Click map or use button" required readonly>
            <button type="button" onclick="getCurrentLocation()" style="margin-top:5px;">📍 Use Current Location</button>
        </div>

        <!-- Map -->
        <div id="map" style="height:300px; width:100%; margin-top:10px; border-radius:10px;"></div>

        <button type="submit" name="submit" class="btn">Submit Repair Request</button>
    </div>
</form>
</div>

<script>
    // Initialize map (default: Colombo)
    var map = L.map('map').setView([6.9271, 79.8612], 10);

    // Load OSM tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Marker
    var marker = L.marker([6.9271, 79.8612], {draggable:true}).addTo(map);

    // Update input with full place name
    function updateLocation(lat, lng) {
        const locationInput = document.getElementById("location");
        locationInput.value = "Fetching address...";

        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`, {
            headers: {
                "Accept": "application/json",
                "User-Agent": "RepairServiceApp/1.0"
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.display_name) {
                locationInput.value = data.display_name;
                marker.bindPopup("📍 " + data.display_name).openPopup();
            } else {
                locationInput.value = `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
            }
        })
        .catch(err => {
            console.log(err);
            locationInput.value = `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
        });
    }

    // Marker drag event
    marker.on('drag', function(e) {
        var latlng = marker.getLatLng();
        updateLocation(latlng.lat, latlng.lng);
    });

    // Map click event
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateLocation(e.latlng.lat, e.latlng.lng);
    });

    // Use Current Location
    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                map.setView([lat, lng], 14);
                marker.setLatLng([lat, lng]);
                updateLocation(lat, lng);
            }, function() {
                alert("Unable to get your location.");
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
</script>
</section>

<section class="repairs">
    <h1 class="heading">Repair Service Details</h1>
    <div class="box-container">
        <?php
            $stmt = $conn->query("SELECT r.*, u.name as uname 
                    FROM repairs r 
                    JOIN users u ON r.user_id=u.id 
                    ORDER BY r.created_at DESC");

            $repairs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(count($repairs) > 0){
                foreach($repairs as $row){
                    $servicerName = "Not Assigned";
                    if($row['servicer_id']){
                        $s = $conn->query("SELECT name FROM servicers WHERE id=".$row['servicer_id']);
                        $servicer = $s->fetch(PDO::FETCH_ASSOC);
                        $servicerName = $servicer['name'];
                    }
        ?>
        <div class="box">
            <p>Request ID : <span><?= $row['id']; ?></span></p>
            <p>User : <span><?= $row['uname']; ?></span></p>
            <p>Repair Type : <span><?= $row['repair_type']; ?></span></p>
            <p>Description : <span><?= $row['repair_details']; ?></span></p>
            <p>Created On : <span><?= $row['created_at']; ?></span></p>
            <p>Admin accept : 
                <span style="color:<?= $row['admin_status'] == 'pending' ? 'red':'green'; ?>">
                <?= $row['admin_status']; ?>
                </span></p>
            <p>Repair Status : 
                <span style="color:<?= $row['servicer_status'] == 'pending' ? 'red':'green'; ?>">
                <?= $row['servicer_status']; ?>
                </span>
            </p>
            <p>Servicer : <span><?= $servicerName; ?></span></p>
            
            <a href="repair_ser.php?delete=<?= $row['id']; ?>" 
                class="delete-btn" 
                onclick="return confirm('Are you sure you want to delete this repair request?');">
                <i class="fas fa-trash"></i> Delete
            </a>
        </div>
        <?php
            }
        }else{
            echo '<p class="empty">No repair requests found!</p>';
        }
        ?>
    </div>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
