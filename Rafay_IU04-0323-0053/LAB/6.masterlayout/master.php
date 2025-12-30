<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$content = '';
switch ($page) {
    case 'about':
        $content = '<h2>About Us</h2><p>We are a company dedicated to providing excellent services.</p>';
        break;
    case 'services':
        $content = '<h2>Our Services</h2><ul><li>Service 1</li><li>Service 2</li><li>Service 3</li></ul>';
        break;
    case 'contact':
        $content = '<h2>Contact Us</h2><form><input type="text" placeholder="Name"><br><input type="email" placeholder="Email"><br><textarea placeholder="Message"></textarea><br><button type="submit">Send</button></form>';
        break;
    default:
        $content = '<h2>Welcome Home</h2><p>This is the homepage content.</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Layout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            background-color: #444;
            padding: 0.5rem;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        nav li {
            margin: 0 1rem;
        }
        nav a {
            color: white;
            text-decoration: none;
        }
        main {
            flex: 1;
            padding: 2rem;
            display: flex;
        }
        .sidebar {
            width: 20%;
            background-color: #f4f4f4;
            padding: 1rem;
        }
        .content {
            width: 80%;
            padding: 1rem;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Site Title</h1>
    </header>
    <nav>
        <ul>
            <li><a href="?page=home">Home</a></li>
            <li><a href="?page=about">About</a></li>
            <li><a href="?page=services">Services</a></li>
            <li><a href="?page=contact">Contact</a></li>
        </ul>
    </nav>
    <main>
        <aside class="sidebar">
            <h2>Sidebar</h2>
            <ul>
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
            </ul>
        </aside>
        <section class="content">
            <?php echo $content; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Your Site. All rights reserved.</p>
    </footer>
</body>
</html>