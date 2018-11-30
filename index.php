<?php

/*************************
 * To understand please read comments. 
 *************************/

/**
 * Things to be considered while submitting forms. 
 * 
 * For security. 
 * 
 * You must save avoid sql injection for security. 
 * Never save it directly to database or use in any query.
 * 
 * there are two simple ways to avoid any sql injectino. 
 * Using pdo or mysqli you must use parametrized queries. 
 * 
 * Also before saving text to database that contains 
 * special characters or tags, you must use
 * html_entities, and special characters encoding
 * and when outputing this data should use 
 * 
 */

//processing input. 

//$value = "<h1>Testing </h1> <input type='text'/> sohail sohail sohail sohail sohail khan sohail khan sohail khan sohail khan sohail khan testing testing sohail khan is testing sohail khan is testing. <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

$value = '';
$output = '';
$count = 0;
$words = array();
if(isset($_POST['input_text'])){

    $value = $_POST['input_text']; 
    $output = htmlspecialchars($value);
    
    //I assume when you want to count words from text
    //not tags if user inputs some html in input form. 
    
    $plain_text = strip_tags($value);

    //Also I assume all words should be considered lower case,
    // like Raja and raja should be considered one word.  
    $plain_text = strtolower($plain_text);
    //count total words.
    $count = str_word_count($plain_text);
    //break words into array
    $words = str_word_count($plain_text,1);
    //count each word occurance. 
    $sorted_words = array_count_values($words);
    //sort by descending. 
    arsort($sorted_words);
    
}

?>

<html>

<head>
    <title>Chaiwala test</title>

    <style>
        .box {
            margin: auto;
            width: 600px;
            height: auto;
            min-height:700px;
            border: 1px solid #ccc;
            padding: 10px;
            word-wrap:break-word;
        }

        h3 {
            text-align: center;
            word-wrap:break-word;
        }

        textarea {
            width: 100%;
            height: 100px;
            resize: none;
        }
    </style>
</head>

<body>

    <div class="box">
        <h3>Chai wala test</h3>

        <form method="POST">
            Text :
            <br>
            <textarea name="input_text"><?php echo $value; ?></textarea>
            <br>
            <br>
            <input type="submit" name="Submit" />

        </form>

        <?php if(strlen($output) > 0 || $count > 0){ ?>
        <h3>Total words
            <?php echo $count; ?>
        </h3>
        <ul>
            <?php foreach($sorted_words as $word => $word_count){  ?>
            <li>
                <?php echo $word." : ".$word_count; ?>
            </li>
            <?php } ?>
        </ul>
        <h3>Same content</h3>
        <?php echo $output; ?>

        <?php } ?>


    </div>

</body>

</html>
