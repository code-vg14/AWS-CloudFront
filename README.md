# AWS-CloudFront
Connect and get content from AWS cloudFront

Connect and fetch preassigned Url from AWS cloudFront using CakePHP3 install aws SDK. 

You can get installation instructions on this link:- https://docs.aws.amazon.com/aws-sdk-php/v3/guide/getting-started/installation.html

Use this method to fetch preassigned urls for your content -

getCloudFrontContent($path); //** $path is the path to your content.

Usage:

    $cloudFrontContent = new AwsController();
    $file = $cloudFrontContent->getCloudFrontContent($path);
    echo($file);
