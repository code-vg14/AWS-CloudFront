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

You can also use ajax request to get content from cloudfront.

                    $.ajax({
                            type: "POST",
                            url: url,           //*url to AWSController method*//
                            data: {"path":source},      //* path to your content*//
                            dataType : 'json',
                            beforeSend: function(xhr){
                                xhr.setRequestHeader('X-CSRF-Token',csrfToken);
                            }, 
                            success: function(data){         
                                //*Do your stuff here with data returned*//
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                              console.log('error');        
                           }
                        });
