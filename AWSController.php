<?php
namespace App\Controller;

use App\Controller\AppController;
use Aws\CloudFront\CloudFrontClient;
use Aws\CloudFront\Exception\CloudFrontException;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Cake\Core\Configure;
use Cake\Event\Event;

class AwsController extends AppController
{
	public function beforeFilter(Event $event){
	
		parent::beforeFilter($event);
	}
	public function getCloudFrontObject(){
		
		try{
			$this->autoRender = false;
			$cfCredentials = Configure::read('CLOUDFRONT_CREDENTIALS');
			$cloudFront = new CloudFrontClient([
					'region'  => $cfCredentials['REGION'],
					'version' => $cfCredentials['VERSION']
			]);	
				
			return $cloudFront;
			
		}catch (CloudFrontException $e) {
			echo $e->getMessage() . "\n";
		}
	}
	
	public function getCloudFrontContent($path = null){
		
		try{
			$this->autoRender = false;
			if(isset($this->request->data['path'])){
				$path = $this->request->data['path'];			
			}	
			$cloudFront = $this->getCloudFrontObject();
			$cfCredentials = Configure::read('CLOUDFRONT_CREDENTIALS');			
			$expires = time() + 10;
			// Create a signed URL for the resource using the canned policy
			$signedUrlCannedPolicy = $cloudFront->getSignedUrl([
					'url'         => $cfCredentials['CF_CONTENT_URL'].$path,
					'expires'     => $expires,
					'private_key' => WWW_ROOT.'/'.$cfCredentials['PRIVATE_KEY'],
					'key_pair_id' => $cfCredentials['KEY_PAIR']
			]);			
			if ($this->request->is('ajax') &&  isset($this->request->data['path']))	{
				echo json_encode(['url'=>$signedUrlCannedPolicy]);
			}else{
				
				return $signedUrlCannedPolicy;
			}			
			
		}catch (CloudFrontException $e) {
			echo $e->getMessage() . "\n";
		}		
	}
		
}
