<?php
require_once("../Config/database.php");

if (isset($_GET['id_article'])) {
    $article_id = $_GET['id_article'];
    $details = $article->selectArticle_info($article_id);

    foreach ($details as $detail) {
    
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.9/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <link href="https://fonts.cdnfonts.com/css/georgina-script" rel="stylesheet">
</head>

<body class="w-full max-w-[70vw] flex flex-col items-center justify-center mx-">

    <div>
        <!-- Replace PHP content with static content -->
        <h1 class="text-6xl font-serif font-bold py-8"><?=$detail['article_title']?></h1>

        <div class="flex flex-col gap-2">
            <div class="flex">
                <img src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144"
                    alt="User profile" class="mr-2 w-10 h-10 rounded-full">
                <div class="flex flex-col">
                    <div class="flex gap-2">
                        <h1><?=$detail['nom']?></h1>
                        <p class="text-green-[#1A8917] text-[#1A8917]">.Follow</p>
                    </div>
                    <p class="text-[#6B6B6B] text-xs"><?=$detail['created_at'] ?></p>
                </div>
            </div>
        </div>
        <div class="flex border border-b-[#F2F2F2] border-t-[#F2F2F2] my-5">
            <div class="drawer drawer-end">
                <!-- Replace PHP content with static content -->
                <div class="drawer-content">
                    <div class="flex">
                        <!-- Add your static content here -->
                    </div>
                </div>
                <div class="drawer-side">
                    <!-- Replace PHP content with static content -->
                    <ul class="menu p-4 w-80 min-h-full bg-base-100 text-base-content">
                        <h3 class="mx-auto text-center">What are your thoughts?</h3>
                        <label for="user-comment" class="text-xs opacity-50">Your Comment:</label>
                        <input type="text" id="user-comment" class="input input-bordered w-full mt-1" name="comment"
                            placeholder="Type your comment..." onkeydown="submitOnEnter(event)">
                        <button onclick="submitComment()">Add</button>
                        <!-- Add your static content here -->
                    </ul>
                </div>
            </div>
            <div class="flex">
                <!-- Add your static content here -->
            </div>
        </div>
        <!-- Replace PHP content with static content -->
        <img src="../assets/images/<?=$detail['article_image'] ?>" alt="Article Image" style="max-width: 30%;">
        <!-- Replace PHP content with static content -->
        <p class="font-georgina text-xl"><?=$detail['content']?></p>
    </div>
<?php }?>
    <script>
        // Your JavaScript code here
    </script>

</body>

</html>
