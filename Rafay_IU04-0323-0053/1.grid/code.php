<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f4f4f4; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; max-width: 1200px; margin: 0 auto; }
        .item { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .item img { width: 100%; height: auto; border-radius: 4px; }
        .item h3 { margin: 10px 0; }
    </style>
</head>
<body>
    <h1>My Portfolio</h1>
    <div class="grid">
        <?php
        $items = [
            ['title' => 'Project 1', 'image' => 'https://via.placeholder.com/250x150', 'desc' => 'Description 1'],
            ['title' => 'Project 2', 'image' => 'https://via.placeholder.com/250x150', 'desc' => 'Description 2'],
            ['title' => 'Project 3', 'image' => 'https://via.placeholder.com/250x150', 'desc' => 'Description 3'],
            ['title' => 'Project 4', 'image' => 'https://via.placeholder.com/250x150', 'desc' => 'Description 4'],
        ];
        foreach ($items as $item) {
            echo "<div class='item'><img src='{$item['image']}' alt='{$item['title']}'><h3>{$item['title']}</h3><p>{$item['desc']}</p></div>";
        }
        ?>
    </div>
</body>
</html>