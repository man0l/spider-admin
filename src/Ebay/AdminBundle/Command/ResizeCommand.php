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


class ResizeCommand extends ContainerAwareCommand
{
    function configure()
    {
        $this
                ->setName('bot:resize')
                ->setDescription('Resize all images for the amazon items')
                
                ;
                
                
    }
    
    function execute(InputInterface $input, OutputInterface $output) {
        
            $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');
            $rep = $em->getRepository("EbayAdminBundle:AmazonItemImages");
            //$images = $rep->findAll();
            $images = $rep->findBy(array('isResized' => 0), array(), 50);
            
            
            $rootDir = $this->getContainer()->getParameter('kernel.root_dir') . "/../web/images/";
            $thumbPath = $rootDir ."resized/";
            $width = 1500;
            $height = 1500;
            $destWidth = $destHeight = 0;
            
            foreach($images as $im)
            {
                $pos = (int)$im->getDisplayOrder();
                $path = $im->getPath();
                $newPath = str_replace("full/", "", $im->getPath());
                $imageine = new Imagine();
                
                $output->writeln($path);
                
                $image = $imageine->open($rootDir.$path);
                
                $boxSize = $image->getSize();
                 
                if($boxSize->getWidth() > $boxSize->getHeight())
                {
                    $destWidth  = $width;
                    $destHeight = $boxSize->getHeight() * ($height / $boxSize->getWidth());
                    
                } else if($boxSize->getWidth() < $boxSize->getHeight())
                {
                    $destWidth  = $boxSize->getWidth() * ($width / $boxSize->getHeight());
                    $destHeight = $height;

                } else if($boxSize->getWidth() == $boxSize->getHeight())
                {
                    $destWidth = $width;
                    $destHeight = $height;                          
                }
                
                 
                $image->resize(new Box($destWidth + $pos, $destHeight + $pos))->save($thumbPath.$newPath); 
                
                $im->setIsResized(1);
                $em->persist($im);
            }
            
            $em->flush();   
            
            
            
    }
}