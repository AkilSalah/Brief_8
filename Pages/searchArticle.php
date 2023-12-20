<?php 
require_once("../Config/database.php");

    if(isset($_GET['query'])){
    $title=$_GET['query'];
    
    $titles = $article->searchArticle($title);
    foreach($titles as $title){

?>

<div 
class=" w-[28%] h-[65vh] mb-[3rem] max-w-sm bg-white border  border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a class="w-[100%]" href="article.php?id=<?php echo $title['article_id'] ?>">
                        <img class="h-[38vh] w-[100%]  rounded-t-lg" src="../assets/images/<?=$title['article_image']?>"
                            alt="product image" />
                    </a>
                    <div class="px-5 pb-5">
                        <div class="h-[10vh]">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                <?php echo $title["article_title"]; ?>
                            </h5>

                        </div>
                        <div class="flex items-center mt-2.5 mb-5">
                            <div class="flex text-gray-600 items-center space-x-1 rtl:space-x-reverse">
                                <p>author :
                                    <?php echo $title["nom"]; ?>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between  h-[20%]">
                          
                            <div class="flex items-center gap-[5px]">
                                <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" fill="gray"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                </svg>
                                <p class=" text-gray-600 text-[12px] ">
                                    <?php echo $title["created_at"]; ?>
                                </p>
                            </div>
                            <form action="article_info.php" method="get">
                            <input type="hidden" name="id_article" value="<?=$title['article_id']?>">
                            <button type="submit" class="bg-green-800 hover:bg-gray-600 text-white font-bold py-2 px-2 rounded">
                                Découvrez plus
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
   
        <?php
}
    }

?>
