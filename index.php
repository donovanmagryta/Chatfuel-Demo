<?php
$question = urldecode($_GET["question"]);
$answer = urldecode($_GET["answer"]);
//$contenttype = urldecode($_GET["contenttype"]); // needed for multiple media types ability
$mode = urldecode($_GET["mode"]);
$stepnum = urldecode($_GET["stepnum"]);

if ($mode == 'ask a question') {
    $filename = $question . "txt";
    $myfile = fopen($filename, "r") or die('{"redirect_to_blocks": ["error"]}');
    $data = fread($myfile, filesize($filename));
    fclose($myfile);
    echo '{"messages":[{"text":"' . $data . '"}]}';

}

if ($mode == 'next') {
    $stepnum  = ++$stepnum;
    $filename = $question . $stepnum . "txt"; // Question is also the image title.
    $myfile = fopen($filename, "r") or die('{"redirect_to_blocks": ["error"]}'); // r = READ ONLY! add rw php later!
    $data = fread($myfile, filesize($filename));
    fclose($myfile);
    echo '{"messages":[{"text":"'.$data.'"}], "set_attributes":{"stepnum":"'.$stepnum.'"}}';
}
    
if ($mode == 'back') {
    $stepnum  = --$stepnum;
    $filename = $question . $stepnum . "txt"; // Question is also the image title. 
    $myfile = fopen($filename, "r") or die('{"redirect_to_blocks": ["error"]}'); //read only!!!
    $data = fread($myfile, filesize($filename));
    fclose($myfile);
     echo '{"messages":[{"text":"'.$data.'"}], "set_attributes":{"stepnum":"'.$stepnum.'"}}';
    
}
if ($mode == 'add or edit Q&A') {
    $filename = $question . "txt";
    $myfile = fopen($filename, "w") or die('{"redirect_to_blocks": ["error"]}');
    $data = fwrite($myfile, $answer);
    fclose($myfile);
    echo '{"messages":[{"text":"memorized!"}]}';
}

if ($mode == 'add or edit step') {
    $filename = $question . $stepnum . "txt"; 
    $myfile = fopen($filename, "w") or die('{"redirect_to_blocks": ["error"]}');
    $data = fwrite($myfile, $answer);
    fclose($myfile);
    echo '{"messages":[{"text":"memorized!"}]}';
}

//IF file contents is a video (need to make a selection)
//echo '{"messages":[{"attachment": {"type": "image","payload": {"url": "'.$data.'"}}}]}';
//	}
?>
