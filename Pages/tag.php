<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-lg shadow-md w-full md:w-96">
    <h2 class="text-xl font-semibold mb-4">Add Tags</h2>
    <form method="post" action="../controller/admin/add_tag.php">
        <div class="mb-6">
            <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">tags</label>
            <input name="theme_tag" type="text" id="default-input" placeholder="example: test text " class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        </div>
        <input name="tag_submit" class="mt-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" value="Add theme" type="submit">
    </form>
</div>

</body>

</html>
