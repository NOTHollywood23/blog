<h4>Dashboard</h4>
<div class="row justify-content-center">

    <?php
    $items = [
        ['icon' => 'bi bi-person-video3', 'label' => 'Admins', 'query' => "select count(id) as num from users where role = 'admin'"],
        ['icon' => 'bi bi-person-circle', 'label' => 'Users', 'query' => "select count(id) as num from users where role = 'user'"],
        ['icon' => 'bi bi-tags', 'label' => 'Categories', 'query' => "select count(id) as num from categories"],
        ['icon' => 'bi bi-file-post', 'label' => 'Posts', 'query' => "select count(id) as num from posts"]
    ];

    foreach ($items as $item) {
        $res = query_row($item['query']);
        echo "
        <div class='m-1 col-md-4 bg-light rounded shadow border text-center' style='padding: 10px; height: auto;'>
            <h1 style='font-size: 2rem; margin-bottom: 5px;'><i class='{$item['icon']}'></i></h1>
            <div style='font-size: 1rem; margin-bottom: 5px;'>{$item['label']}</div>
            <h1 class='text-primary' style='font-size: 2rem;'>" . ($res['num'] ?? 0) . "</h1>
        </div>
        ";
    }
    ?>
    
</div>
