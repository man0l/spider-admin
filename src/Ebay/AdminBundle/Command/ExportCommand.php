<?php
namespace Ebay\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Imagine\Image\Box;
use Imagine\Imagick\Imagine;
use Ebay\AdminBundle\Entity\AmazonItemImages;
use Ebay\AdminBundle\Api\EbaySession;


class ExportCommand extends ContainerAwareCommand
{
    private $ebaySession;
    private $verb = 'UploadSiteHostedPictures';
    private $version = 517;
    private $userToken ='AgAAAA**AQAAAA**aAAAAA**HMPEVA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AFkIumDZmFpwWdj6x9nY+seQ**2ZUCAA**AAMAAA**kXFksVKw9qZq5l9cvvPxXj0P9uxv3REiSjluFKpZ1xRl3PUMuI05HHZvvNqboZ24ygy0O6UUB2vKHaf7g5/o6Pitnr+eT61QzQX0ae9hDuPNocL9+N8SsGZmo8fCVlIIImEWE08Vj99WMCIQSpNpRyRHmxyKub59wOrv1M5JT2BOpp+szDmk7vlEFHRuD0wTSs9/uhqlLhNGmkdzmD4kb1bxNEaaCgJENQLwiyuKJqMf+0OtxOjc4dVN5vz/PcBfccT7fOytr237hNgUkRvWyjx8zkZAplmdkbMHe8bQnhWgDLt9hNI21Ljh8IL3hCfbsb1GXkC1Fp0uu7lFz0U2k+khrxGRplg4UYi3Zlus0oDwXCODxUw9uz/XPab6A52v8sIzsNoj8tAqkpAXFY13mRbH7M2diuGAAmwBWSUUagtyfJOYJ6w85qQ1S6k1qhlLQmWYKOSd2L7sf+k7bx42d27GmjhEV/4BWo1eVdKwl2xKy9g8CJPStjVazdz1Qs9ndWknRCvjTI4R1muwF/YVsCQE/KkHsqdhq5rszRreJeUXZSL1aGBLKFxeqrsCkXhJUohAwa64hLgywXJLVTr38GwiM8QZO4ATFskxYM0CoSAjGOTmSZ4U4rpc3CQaBS3hZgPnxIPv1M8+/ED6EADrv7EgCoDEDdhw7drmW4tfv6wW4a0ivI1+9q5APcwvckHijETzkRhPDwROib6K7mWcUfpg52KPcOnbuVNRmsPr/iPnwN0Xb25HeGgNzX4xwXBP';
    function configure()
    {
        $this
                ->setName('bot:export')
                ->setDescription('Export the items in FileExchange')     
                ->addArgument('date', InputOption::VALUE_REQUIRED, "Export Date Parameter Start")
                ->addArgument('date_end', InputOption::VALUE_OPTIONAL, "Export Date Parameter End")    
                ->addArgument('limit', InputOption::VALUE_OPTIONAL, 'Limit')
                ;
                
                
    }
    
    function initSession()
    {
            $devID = 'c5b7973e-8d76-4142-9fca-9e997ac8b5fd';
            $appID = 'Trakink60-c128-49e7-ac40-3f4452ee717';
            $certID = 'a508490a-ae05-4081-aedf-9199b7254402';

            //the token representing the eBay user to assign the call with
            //$userToken = 'AgAAAA**AQAAAA**aAAAAA**HMPEVA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AFkIumDZmFpwWdj6x9nY+seQ**2ZUCAA**AAMAAA**kXFksVKw9qZq5l9cvvPxXj0P9uxv3REiSjluFKpZ1xRl3PUMuI05HHZvvNqboZ24ygy0O6UUB2vKHaf7g5/o6Pitnr+eT61QzQX0ae9hDuPNocL9+N8SsGZmo8fCVlIIImEWE08Vj99WMCIQSpNpRyRHmxyKub59wOrv1M5JT2BOpp+szDmk7vlEFHRuD0wTSs9/uhqlLhNGmkdzmD4kb1bxNEaaCgJENQLwiyuKJqMf+0OtxOjc4dVN5vz/PcBfccT7fOytr237hNgUkRvWyjx8zkZAplmdkbMHe8bQnhWgDLt9hNI21Ljh8IL3hCfbsb1GXkC1Fp0uu7lFz0U2k+khrxGRplg4UYi3Zlus0oDwXCODxUw9uz/XPab6A52v8sIzsNoj8tAqkpAXFY13mRbH7M2diuGAAmwBWSUUagtyfJOYJ6w85qQ1S6k1qhlLQmWYKOSd2L7sf+k7bx42d27GmjhEV/4BWo1eVdKwl2xKy9g8CJPStjVazdz1Qs9ndWknRCvjTI4R1muwF/YVsCQE/KkHsqdhq5rszRreJeUXZSL1aGBLKFxeqrsCkXhJUohAwa64hLgywXJLVTr38GwiM8QZO4ATFskxYM0CoSAjGOTmSZ4U4rpc3CQaBS3hZgPnxIPv1M8+/ED6EADrv7EgCoDEDdhw7drmW4tfv6wW4a0ivI1+9q5APcwvckHijETzkRhPDwROib6K7mWcUfpg52KPcOnbuVNRmsPr/iPnwN0Xb25HeGgNzX4xwXBP';

            $siteID  = 0;                            // siteID needed in request - US=0, UK=3, DE=77...
            $verb    = 'UploadSiteHostedPictures';   // the call being made:
            $version = 933;                          // eBay API version
            $boundary = "MIME_boundary";
            
            $this->ebaySession = new eBaySession($this->userToken, $devID, $appID, $certID, false, $this->version, $siteID, $this->verb, $boundary);
            
    }
    
    function sendRequest($filePath) 
    {
        if(!$this->ebaySession)
            throw new \Exception('The eBaySession is not set');        
        
        $file = $filePath;
        $picNameIn = 'my_pic';
        $handle = fopen($file,'r');         // do a binary read of image
        $multiPartImageData = fread($handle,filesize($file));
        fclose($handle);

        ///Build the request XML request which is first part of multi-part POST
        $xmlReq = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
        $xmlReq .= '<' . $this->verb . 'Request xmlns="urn:ebay:apis:eBLBaseComponents">' . "\n";
        $xmlReq .= "<Version>{$this->version}</Version>\n";
        $xmlReq .= "<PictureName>$picNameIn</PictureName>\n";    
        $xmlReq .= "<RequesterCredentials><eBayAuthToken>{$this->userToken}</eBayAuthToken></RequesterCredentials>\n";
        $xmlReq .= '</' . $this->verb . 'Request>';

        $boundary = "MIME_boundary";
        $CRLF = "\r\n";

        // The complete POST consists of an XML request plus the binary image separated by boundaries
        $firstPart   = '';
        $firstPart  .= "--" . $boundary . $CRLF;
        $firstPart  .= 'Content-Disposition: form-data; name="XML Payload"' . $CRLF;
        $firstPart  .= 'Content-Type: text/xml;charset=utf-8' . $CRLF . $CRLF;
        $firstPart  .= $xmlReq;
        $firstPart  .= $CRLF;

        
        $secondPart = "--" . $boundary . $CRLF;
        $secondPart .= 'Content-Disposition: form-data; name="dummy"; filename="dummy"' . $CRLF;
        $secondPart .= "Content-Transfer-Encoding: binary" . $CRLF;
        $secondPart .= "Content-Type: application/octet-stream" . $CRLF . $CRLF;
        $secondPart .= $multiPartImageData;
        $secondPart .= $CRLF;
        $secondPart .= "--" . $boundary . "--" . $CRLF;

        $fullPost = $firstPart . $secondPart;
      
        return $this->ebaySession->sendHttpRequest($fullPost);

    }
    
    function execute(InputInterface $input, OutputInterface $output) {
        
            $date = $input->getArgument('date');
            $dateEnd = $input->getArgument('date_end');
            $dateParam = new \DateTime(date('Y-m-d H:i:s',strtotime($date)));
            $dateEndParam = new \DateTime(date('Y-m-d H:i:s',strtotime($dateEnd)));
            $limitParam = intval($input->getArgument('limit'));
            
            $this->initSession();
            
            $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');
             
            $rep = $em->getRepository("EbayAdminBundle:AmazonItem");
            $repIm = $em->getRepository("EbayAdminBundle:AmazonItemImages");
            
            $pathDir = $this->getContainer()->getParameter('kernel.root_dir') . "/../web/export/";
            $imageDir = $this->getContainer()->getParameter('kernel.root_dir'). "/../web/images/";
            
            $conn = $em->getConnection();               
            $sql = "
                    SELECT ai.*, i.category, i.price, i.brand, i.upc, i.ean, i.mpn, count(distinct iis.id) AS sold, group_concat(DISTINCT REPLACE(aii.path, 'full/', 'resized/') separator ';') AS images_list, ROUND((i.price - (i.price * 0.144) - 0.3) - ai.price, 2) AS profit
                    FROM amazon_item ai
                    LEFT JOIN amazon_item_images aii ON ai.id = aii.amazon_id
                    INNER JOIN item i ON ai.asin = i.main_asin
                    LEFT JOIN item_sold iis ON i.id = iis.item_id
                    WHERE ai.created_at > :created_at AND ai.created_at < :created_at_end
                ";
            
            if($limitParam > 0)
            {
                $sql .= " LIMIT 0, :limit";
            }
            

            $sql .= " GROUP BY  ai.id";
            
            $stmt = $conn->prepare($sql);   
            $stmt->bindValue('created_at', $dateParam->format('Y-m-d H:i:s'));
            $stmt->bindValue("created_at_end", $dateEndParam->format('Y-m-d H:i:s'));
            
              
            if($limitParam > 0)
            {
                $stmt->bindValue("limit", $limitParam);
            }

            $stmt->execute();
            $results = $stmt->fetchAll();

            $header = "*Action(SiteID=US|Country=US|Currency=USD|Version=745);*Category;*Title;Subtitle;*Description;C:Brand;Product:UPC;C:UPC;C:MPN;*ConditionID=1000;PicURL;*Quantity;*Format=FixedPrice;*StartPrice;UseTaxTable=1;BuyItNowPrice;*Duration=30;ImmediatePayRequired;*Location=90001;GalleryType;PayPalAccepted=1;PayPalEmailAddress=manol.trendafilov@gmail.com;PaymentInstructions;StoreCategory;ShippingDiscountProfileID;DomesticRateTable;ShippingType=Flat;ShippingService-1:FreeShipping=1;ShippingService-1:Option=ShippingMethodStandard;ShippingService-1:Cost;ShippingService-1:Priority;ShippingService-1:ShippingSurcharge;ShippingService-2:Option;ShippingService-2:Cost;ShippingService-2:Priority;ShippingService-2:ShippingSurcharge;GlobalShipping=0;DispatchTimeMax=2;CustomLabel;ReturnsAcceptedOption=ReturnsAccepted;RefundOption=MoneyBackOrReplacement;RestockingFeeValueOption=NoRestockingFee;ReturnsWithinOption=Days_30;ShippingCostPaidByOption=Seller;AdditionalDetails;ShippingProfileName;ReturnProfileName;PaymentProfileName\r\n";
            
            $fileName = sprintf("%s_export.csv", date('Y-m-d'));
            $fp = fopen($pathDir.$fileName, "w");
            fwrite($fp, $header);
            
            foreach($results as $result)
            {
                $imagesList = array();
                // upload the images
                if($result['images_list'])
                {
                    $imgs = explode(";", $result['images_list']);
                    // check for 12 images, copy them until the number become 12
                    
                    $size = count($imgs);
                    
                    if($size < 12)
                    {
                        for($i = 0; $i < 12 - $size; $i++)
                        {
                           $imgs[] = $imgs[$i];
                        }
                    }
                     
                    foreach($imgs as $image)
                    {
                        if(file_exists($imageDir.$image) && (filesize($imageDir.$image) > 0)) 
                        {
                            $output->writeln($image); 
                            $response = $this->sendRequest($imageDir.$image, "UploadSiteHostedPictures");

                            $output->writeln(var_dump($response));

                            if(!stristr($response, 'HTTP 404') || $response !== '')
                            {
                                $respXmlObj = simplexml_load_string($response);  
                                $ack        = $respXmlObj->Ack;
                                $picNameOut = $respXmlObj->SiteHostedPictureDetails->PictureName;
                                $picURL     = $respXmlObj->SiteHostedPictureDetails->FullURL;

                                $imagesList[] = $picURL;
                            }
                        }

                    }
                }
               
                // export csv
                fputcsv($fp, array(
                    "VerifyAdd",
                    $result['category'],
                    preg_replace("/\n?\r?/", "", $result['title']),
                    '',
                    trim(preg_replace('/\s+/', ' ', $result['description'])),
                    $result['brand'] ?: 'Does not apply',
                    $result['upc'] ?: 'Does not apply', // Product:UPC
                    $result['upc'] ?: 'Does not apply', // twice, because of the C:UPC 
                    $result['mpn'] ?: 'Does not apply',                    
                    '',
                    sprintf("%s",implode("|", $imagesList)),
                    1,
                    '',
                    $result['price'], // startPrice
                    '',
                    '', //$result['price'], // buyNowPrice
                    '',
                    '',
                    '',
                    '',
                    '',
                    '', // paypal address
                    '',
                    '',
                    '',
                    '', // shipping type flat
                    '', // shipping service freeshipping
                    '', // ShippingMethodStandard
                    '',
                    '',
                    '',
                    '', // shipping service 2 option
                    '',
                    '',
                    '',
                    '',
                    '', // globalshipping
                    '', // dispatch time
                    '', // returs accepted
                    '', // restocking fee NoRestockingFee.
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    ''
                    
                ), ";");
            }
            
    }
}