<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body{
    background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
    overflow: hidden;
    height: 100vh;  
    }
    .banner{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        text-align: center;
        z-index: 100;
    }
    .content h3 b{
        -webkit-text-fill-color: transparent
        -webkit-text-stroke-width: 3px;
        -webkit-text-stroke-color: #918484ff;
        font-family: 'Times New Roman', Times, serif;   
        font-size: 50px;
    }

    .round{
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: rgba(212, 193, 193, 0.9);
        filter:drop-shadow(0 0 15px #fff);
        /* animation: animate 10s linear infinite ; */
    }
    .round:nth-child(1){
        opacity: 0.6;
        transform: translate(56vw, -10px);
        animation: ani-1 22s -16s linear infinite;

    }
    @keyframes ani-1{
        34%{
            transform: translate(57vw, 34vh);
        }
        to{
            transform: translate(57vw, 100vh);
        }
     
    }
    .round:nth-child(2){
        opacity: 0.06;
        transform: translate(38vw, -10px);
        animation: ani-2 17s -20s linear infinite;

    }
    @keyframes ani-2{
        70%{
            transform: translate(37vw, 70vh);
        }
        to{
            transform: translate(37vw, 100vh);
        }
     
    }
    .round:nth-child(3){
        opacity: 0.7;
        transform: translate(18vw, -10px);
        animation: ani-3 10s -24s linear infinite;

    }
    @keyframes ani-3{
        71%{
            transform: translate(22vw, 71vh);
        }
        to{
            transform: translate(20vw, 100vh);
        }
     
    }
    .round:nth-child(4){
        opacity: 0.7;
        transform: translate(59vw, -10px);
        animation: ani-4 25s -3s linear infinite;

    }
    @keyframes ani-4{
        73%{
            transform: translate(51vw, 73vh);
        }
        to{
            transform: translate(55vw, 100vh);
        }
     
    }
    .round:nth-child(5){
        opacity: 0.4;
        transform: translate(47vw, -10px);
        animation: ani-5 20s -18s linear infinite;

    }
    @keyframes ani-5{
        38%{
            transform: translate(42vw, 38vh);
        }
        to{
            transform: translate(45vw, 100vh);
        }
     
    }
    .round:nth-child(6){
        opacity: 0.6;
        transform: translate(82vw, -10px);
        animation: ani-6 16s -19s linear infinite;

    }
    @keyframes ani-6{
        57%{
            transform: translate(83vw, 57vh);
        }
        to{
            transform: translate(82vw, 100vh);
        }
     
    }
    .round:nth-child(7){
        opacity: 0.1;
        transform: translate(30vw, -10px);
        animation: ani-7 17s -27s linear infinite;

    }
    @keyframes ani-7{
        32%{
            transform: translate(22vw, 32vh);
        }
        to{
            transform: translate(26vw, 100vh);
        }
     
    }
    .round:nth-child(8){
        opacity: 0.5;
        transform: translate(11vw, -10px);
        animation: ani-8 10s -19s linear infinite;

    }
    @keyframes ani-8{
        50%{
            transform: translate(6vw, 50vh);
        }
        to{
            transform: translate(9vw, 100vh);
        }
     
    }
    .round:nth-child(9){
        opacity: 0.5;
        transform: translate(81vw, -10px);
        animation: ani-9 13s -8s linear infinite;

    }       
    @keyframes ani-9{
        57%{
            transform: translate(74vw, 57vh);
        }
        to{
            transform: translate(77vw, 100vh);
        }
     
    }
    .round:nth-child(10){
        opacity: 0.7;
        /* transform: translate(91vw, -10px); */
        animation: ani-10 24s -25s linear infinite;

    }
    @keyframes ani-10{
        51%{
            transform: translate(31vw, 51vh);
        }
        to{
            transform: translate(28vw, 100vh);
        }
     
    }
    .round:nth-child(11){
        opacity: 0.5;
        transform: translate(92vw, -10px);
        animation: ani-11 27s -18s linear infinite;

    }
    @keyframes ani-11{
        36%{
            transform: translate(99vw, 36vh);
        }
        to{
            transform: translate(96vw, 100vh);
        }
     
    }
    .round:nth-child(12){
        opacity: 0.9;
        transform: translate(49vw, -10px);
        animation: ani-12 16s -10s linear infinite;

    }
    @keyframes ani-12{
        78%{
            transform: translate(74vw, 78vh);
        }
        to{
            transform: translate(51vw, 100vh);
        }
     
    }
    .round:nth-child(13){
        opacity: 0.3;
        transform: translate(69vw, -10px);
        animation: ani-13 11s -27s linear infinite;

    }
    @keyframes ani-13{
        75%{
            transform: translate(66vw, 75vh);
        }
        to{
            transform: translate(68vw, 100vh);
        }
     
    }
    .round:nth-child(14){
        opacity: 0.2;
        transform: translate(78vw, -10px);
        animation: ani-14 18s -4s linear infinite;

    }
    @keyframes ani-14{
        50%{
            transform: translate(77vw, 50vh);
        }
        to{
            transform: translate(77vw, 100vh);
        }
     
    }
    .round:nth-child(15){
        opacity: 0.9;
        transform: translate(33vw, -10px);
        animation: ani-15 18s -4s linear infinite;

    }
    @keyframes ani-15{
        68%{
            transform: translate(29vw, 68vh);
        }
        to{
            transform: translate(31vw, 100vh);
        }


        /*  */
     
    }
</style>
</head>
<body>
    
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    
    <div class="banner">
        <div class="content">
            <h3>Welcome To Our Website</h3>
        </div>
    </div>



</body>



</html>
<div class="wrapper">
    <form action="">
        <h1>Login</h1>
        <div class="input-box">
            <input type="text" placeholder="Username" required>
            <i class='bx bxs-user' ></i>
        </div>

        <div class="input-box">
            <input type="password" placeholder="Password"required>
            <i class='bx bxs-lock-alt' ></i>
        </div>

        <div class="remember-forgot">
            <lable><input type="checkbox">Remember Me</lable>
            <a href="#">Forgot Password</a>
        </div>

        <button type="submit" class="btn">Login</button>

        <div class="register-link">
            <p>Don't have an account?<a href="#">Register</a></p>   

    </form>
    </div>
        
</div>
<!-- *************** -->
    <nav>
        <a herf = "#">Home<span></span></a>
        <a herf = "#">About<span></span></a>
        <a herf = "#">Services<span></span></a>
        <a herf = "#">Contact<span></span></a>
    </nav>





    
    
    
    
    <!-- ****************** -->
     <style>
        /* <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>     */
    /* *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #000;
    } */

    nav a{
        position: relative;
        color: #333;
        font-size: 1.1em;
        text-decoration: none;
        padding: 6px 20px;
        transition: 0.5s;
        
    }

    nav a:hover{
        color: #0ef;
    }   

    nav a span{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        border-radius: 15px;
        border-bottom: 2px solid #0ef;
        transform: scale(0) translateY(50px);
        transition: 0.5s;
        opacity: 0;
        
    }

    nav a:hover span{
        transform: scale(1) translateY(0px);
        opacity: 1;
    }

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    .body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: radial-gradient(ellipse at bottom, #1b2735ff 0%, #090a0f 100%);
    }

    .wrapper{
        width: 420px;   
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0,0,0,0.2);

        color: #fff;
        border-radius: 10px;
        padding: 30px 40px;
    }
    .wrapper h1{
        font-size: 36px;
        text-align: center;
    }

    .wrapper.input-box{
        width: 100%;
        height: 50px;
        background: rgba(255,255,255,0.2);
        margin: 30px 0;
    }
    .wrapper.input-box input{
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;   
        outline: none;
        border: 2px solid rgba(255,255,255,0.5);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }
    .input-box input::placeholder{
        color: #fff;
    }
    .input-box i{
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }
    .wrapper .remember-forgot{
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        margin: -15px 0 15px;
        color: #fff;
    }
    .remember-forgot lable input{
        accent-color: #fff;
        margin-right: 3px;
    }
    .remember-forgot a{
        color: #fff;
        text-decoration: none;
    }
    .remember-forgot a:hover{
        text-decoration: underline;
    }
    .wrapper .btn{
        width: 100%;
        height: 45px;
        background: #fff;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px #1d1b1bff;
        font-size: 16px;
        font-weight: 600;
        color: #333;
        cursor: pointer;
    }
    .wrapper .register-link{
        font-size: 14.5px;
        text-align: center;
        margin-top: 20px;
        margin: 20px 0 15px;
    }
    .register-link p a{
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }
    .register-link p a:hover{
        text-decoration: underline;
    }

</style>


