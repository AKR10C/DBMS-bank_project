<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Website</title>
   <style>
      body {
    margin: 0; 
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url('bankground.jpg'); /* Path to your background image */
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: #333; /* Text color */
}

header {
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black */
    color: #fff; /* Text color */
    padding: 20px;
    text-align: center;
}

nav {
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
    padding: 10px 0;
    text-align: center;
}

nav a {
    color: #fff;
    text-decoration: none;
    padding: 0 20px;
}

nav a:hover {
    text-decoration: underline;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 0 20px;
}

.content {
    background-color: rgba(191, 170, 240, 0.8); /* Semi-transparent white */
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Shadow effect */
}

footer {
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black */
    color: #fff; /* Text color */
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
}

    </style>
</head>
<body>
    <header>
        <h1>Welcome to ABBank</h1>
        <h4>YOUR PERFECT BANKING PARTNER</h4>
        <div class="container"></div>
        
    </header>
    <nav>
        <a href="staff.php">STAFF LOGIN</a>
        <a href="client.php">CUSTOMER LOGIN</a>
        <a href="service.php">Services</a>
        
    </nav>
    <div class="container">
        <div class="content">
            <h2>About Us,</h2> 
            <p>Welcome to AB Bank, where financial empowerment meets personalized service. As a trusted institution, we're committed to providing seamless banking experiences tailored to your needs. </p>  
         <p>Whether you're saving for the future, investing in your business, or purchasing your dream home, our dedicated team is here to guide you every step of the way.</p>
         <p>With innovative solutions and a focus on building lasting relationships, we strive to be more than just a bank—we're your financial partner, helping you achieve your goals and secure your future. Discover the difference with AB Bank today</p>
        </div>

    </div>
    <footer>
        &copy; CONTACT US ON ABBANK@GMAIL.COM
    </footer>
</body>
</html>