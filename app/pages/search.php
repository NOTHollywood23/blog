<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../app/pages/includes/header.php';
?>

<div> 
    <!-- Featured Posts Section -->
    <div class="featured-posts">
        <h3 class="mx-4">Search</h3>
        <div class="row my-2">
            <?php
                // Set the limit of posts per page
                $limit = 10;

                // Calculate the offset for pagination
                $offset = ($PAGE['page_number'] - 1) * $limit;

                // Get the search term from the query string
                $find = $_GET['find'] ?? null;

                if ($find) {
                    // Prepare the search term for SQL LIKE query
                    $find = "%$find%";

                    // Define the SQL query with a join on the categories table
                    $query = "SELECT posts.*, categories.category FROM posts 
                              JOIN categories ON posts.category_id = categories.id 
                              WHERE posts.title LIKE :find 
                              ORDER BY id DESC 
                              LIMIT $limit OFFSET $offset";

                    // Execute the query and fetch results
                    $rows = query($query, ['find' => $find]);
                }

                // Check if there are any results and display them
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        include '../app/pages/includes/post-card.php';
                    }
                } else {
                    // Display a message if no items were found
                    echo "<p>No items found!</p>";
                }
            ?>
        </div>
    </div>
</div>

<!-- Pagination Buttons -->
<a href="<?=$PAGE['first_link']?>">
    <button class="btn btn-primary mb-4" style="background-color: #001962; color: #ffffff;">First Page</button>
</a>
<a href="<?=$PAGE['prev_link']?>">
    <button class="btn btn-primary mb-4" style="background-color: #001962; color: #ffffff;">Prev Page</button>
</a>
<a href="<?=$PAGE['next_link']?>">
    <button class="btn btn-primary mb-4 float-end" style="background-color: #001962; color: #ffffff;">Next Page</button>
</a>

<?php include '../app/pages/includes/footer.php'; ?>
