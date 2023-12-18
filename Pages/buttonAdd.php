<?php 
require_once("../Config/database.php");
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];}
    if (isset($_SESSION['theme_id'])) {
   $theme_id = $_SESSION['theme_id'];}

?>

<button id="openModal"
    class="flex gap-[5px] text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
    type="button">Add New Article<svg xmlns="http://www.w3.org/2000/svg" height="24" fill="white" viewBox="0 -960 960 960" width="24"><path d="M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160Zm40 200q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
</button>
</div>

<div id="myModal" class="modal">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Create New Article
                    </h3>
                    <button id="closeModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form class="p-4 md:p-5" action="" method="post">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type Article title">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="image"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">image</label>
                            <input type="file" name="image" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="tags"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>
                                <div class="checkbox-container">
                                <?php
                                $tags_query = $article->selectTags($theme_id);
                                foreach ($tags_query as $tags){
                                        ?>
                                        <label><input type="checkbox" name="options[]" value="<?= $tags['tag_name'] ?>"> <a
                                                href="?id_tag=<?= $tags['tag_id'] ?>">
                                                <?= $tags["tag_name"] ?>
                                            </a></label>

                                        <?php
                                    }
                                ?>
                                </div>
                        </div>
                        <div class="col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Article
                                Description</label>
                            <textarea id="description" name="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Write article description here"></textarea>
                        </div>
                    </div>
                    <button type="submit" name="insert"
                        class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add new Article
                    </button>
                </form>
            </div>
        </div>
</div>
        <div id="overlay" class="overlay"></div>

        <script>
    document.addEventListener("DOMContentLoaded", function () {
                const openButton = document.getElementById("openModal");
                const modal = document.getElementById("myModal");
                const closeButton = document.getElementById("closeModal");
                const overlay = document.getElementById("overlay");

                function openModal() {
                    modal.style.display = "block";
                    overlay.style.display = "block";
                }

                function closeModal() {
                    modal.style.display = "none";
                    overlay.style.display = "none";
                }

                openButton.addEventListener("click", openModal);
                closeButton.addEventListener("click", closeModal);
                overlay.addEventListener("click", closeModal);
            });
</script>