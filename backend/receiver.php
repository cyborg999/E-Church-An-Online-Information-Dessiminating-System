<?php
    try
    {
        $message_type = $_POST["message_type"];
    }
    catch (Exception $e)
    {
        echo "Error";
        exit(0);
    }

    if (strtoupper($message_type) == "INCOMING")
    {
        try
        {
            $message = $_POST["message"];
            $mobile_number = $_POST["mobile_number"];
            $shortcode = $_POST["shortcode"];
            $timestamp = $_POST["timestamp"];
            $request_id = $_POST["request_id"];

            echo "Accepted";
            $myfile = fopen("../test/newfile.txt", "w") or die("Unable to open file!");
            $txt = "John Doe\n";
            fwrite($myfile, $txt);
            $txt = "Jane Doe\n";
            fwrite($myfile, $txt);
            fclose($myfile);
            exit(0);
        }
        catch (Exception $e)
        {
            echo "Error";
            exit(0);
        }
    }
    else
    {
        echo "Error";
        exit(0);
    }

?>