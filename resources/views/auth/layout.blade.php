<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Art</title>

</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    ::after,
    ::before {
        box-sizing: border-box;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        position: relative;
    }


    .mb-3 {
        margin-bottom: 20px;
    }

    .form-contain {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 732px;
        height: 557px;
        position: relative;
        background: #d9d9d9;
        border-radius: 27px;
        box-shadow: 18px 25px 29px rgba(0, 0, 0, 0.25);
    }

    .form-list {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .form-list form {
        gap: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .form-list form input {
        border: none;
        width: 226px;
        height: 45.73px;
        background: #ffffff;
        box-shadow: 0px 8px 4px rgba(97, 178, 228, 0.44);
        border-radius: 37px;
        padding: 15px 15px;
    }

    .form-list form input::placeholder {
        padding: 8px;
    }

    .overlay {
        width: 50%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.5s ease-in-out;
        z-index: 1;
        border-radius: 27px;
        box-shadow: 10px 4px 7px rgba(0, 0, 0, 0.24);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .overlay .titre-login {
        gap: 45px;
        flex-direction: column;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        display: none;
    }

    .overlay .titre-register {
        gap: 45px;
        flex-direction: column;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-register {
        color: #000;
        padding: 10px 20px;
        border: none;
        margin-right: 10px;
        display: none;
        background: #cccccc;
        box-shadow: 0px 4px 4px rgba(97, 178, 228, 0.44);
        border-radius: 37px;
        font-size: 20px;
    }

    .btn-login {
        color: black;
        padding: 10px 20px;
        border: none;
        margin-left: 10px;
        background: #cccccc;
        box-shadow: 0px 4px 4px rgba(97, 178, 228, 0.44);
        border-radius: 37px;
        font-size: 20px;
    }

    .decoration {
        position: absolute;
        top: 35px;
        width: 100%;
        border: none;
    }

    .wave-svg {
        position: absolute;
        bottom: 0px;
        width: 100%;
    }

    #snow-container {
        position: absolute;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.04);
    }

    .snowflake {
        position: absolute;
        top: -10px;
        display: block;
        width: 10px;
        height: 10px;
        border: 1px solid #000000;
        background-color: #fff;
        border-radius: 50%;
        opacity: 0.7;
        animation: fall linear infinite;
    }

    @keyframes fall {
        0% {
            transform: translateY(-50px);
        }

        100% {
            transform: translateY(100vh);
        }
    }

    .decoration-back {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .decoration-back .carpet-snow {
        height: 20%;
        width: 100%;
        z-index: 2;
    }

    .decoration-back .tree {
        position: relative;
        top: 100px;
    }

    .is-invalid {
        border-color: red;
    }

    .invalid-feedback {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    /* Style the div container */
    .nut-button {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        /* Add space above the button */
        width: 100%;
        /* Ensure the container stretches to full width */
    }

    /* Style the submit button */
    .nut-button button {
        padding: 12px 25px;
        /* Add padding inside the button */
        background-color: #1da8ff;
        /* Green color for the button */
        color: white;
        border: none;
        border-radius: 30px;
        /* Rounded corners */
        font-size: 16px;
        /* Set font size for button text */
        cursor: pointer;
        width: 100%;
        /* Make the button fill the container */
        max-width: 300px;
        /* Optional: limit the width */
        transition: background-color 0.3s ease, transform 0.3s ease;
        /* Smooth transitions */
    }

    /* Hover effect for the button */
    .nut-button button:hover {
        background-color: #1658b5;
        /* Darker green on hover */
        transform: scale(1.05);
        /* Slightly grow the button on hover */
    }

    /* Focus effect for better accessibility */
    ..nut-button button:active {
        outline: none;
        /* Remove default outline */
        box-shadow: 0 0 5px rgba(15, 47, 255, 0.5);
        /* Green shadow when focused */
    }

    .forgot-password {
        margin-top: 30px;
        text-align: center;
        /* Horizontally center the text */
    }

    .forgot-password h2,
    .forgot-password p {
        margin: 20px;
        /* Remove default margins to ensure even spacing */
        padding: 0;
        /* Remove padding if needed */
    }


    
    /* Style the div container */
    .nut-button {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        /* Add space above the button */
        width: 100%;
        /* Ensure the container stretches to full width */
    }

    /* Style the submit button */
    .nut-button input[type="submit"] {
        padding: 12px 25px;
        /* Add padding inside the button */
        background-color: #1da8ff;
        /* Green color for the button */
        color: white;
        border: none;
        border-radius: 30px;
        /* Rounded corners */
        font-size: 16px;
        /* Set font size for button text */
        cursor: pointer;
        width: 100%;
        /* Make the button fill the container */
        max-width: 300px;
        /* Optional: limit the width */
        transition: background-color 0.3s ease, transform 0.3s ease;
        /* Smooth transitions */
    }

    /* Hover effect for the button */
    .nut-button input[type="submit"]:hover {
        background-color: #1658b5;
        /* Darker green on hover */
        transform: scale(1.05);
        /* Slightly grow the button on hover */
    }

    /* Focus effect for better accessibility */
    .nut-button input[type="submit"]:focus {
        outline: none;
        /* Remove default outline */
        box-shadow: 0 0 5px rgba(15, 47, 255, 0.5);
        /* Green shadow when focused */
    }
</style>

<body>
    @yield('content')
   <!-- SweetAlert2 CDN -->
</body>



</html>
