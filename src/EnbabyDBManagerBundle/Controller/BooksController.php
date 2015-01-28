<?php

namespace EnbabyDBManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EnbabyDBManagerBundle\Entity\Series;
use EnbabyDBManagerBundle\Entity\Books;

DEFINE("WEBROOT","/var/www/EnbabyDB/web");
DEFINE("SnapshotDB","/AudioLib/snapshots/");
DEFINE("AudioDB","/AudioLib/audios/");
DEFINE("Uploads","/AudioLib/uploads/");

class BooksController extends Controller
{
    public function indexAction()
    {
       $em = $this->getDoctrine()->getManager();
       $query = $em->createQuery('SELECT book.isbn,book.displayName FROM EnbabyDBManagerBundle:Books book');
       $index = $query->getResult();

       return $this->render('EnbabyDBManagerBundle:Books:index.html.twig',array('index' => $index));	
    }

   public function bookAction($isbn)
   {
       $book = $this->getDoctrine()->getRepository('EnbabyDBManagerBundle:Books')->find($isbn);

       if(!$book)
       {
          $book = new Books();
          $unlink = $this->getDoctrine()->getRepository('EnbabyDBManagerBundle:Series')->findAll();
          $link = array();
      }else{
          $lc = $this->get('EnbabyDBManagerBundle.Services.LinksDB');
          $link = $lc->getSeriesLinkToBook($isbn);
          $unlink = $lc->getSeriesNotLinkToBook($isbn); 
      }
      return $this->render('EnbabyDBManagerBundle:Books:book.html.twig',array('book' => $book,'link' => $link,'unlink' => $unlink));
    }

public function updateAction(Request $request)
{


    $isbn = $request->request->get('ISBN','NULL');
    if($isbn == 'NULL')
    {
        $response = new Response(json_encode(array('MSG' => '-1')));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    $em = $this->getDoctrine()->getManager();
    $book = $em->getRepository('EnbabyDBManagerBundle:Books')->find($isbn);
    $new = null;
    if(!$book)
    {
        $book = new Books();
        $new = 1;
    }
    $book->setISBN($isbn);
    $book->setDisplayName($request->request->get('DisplayName'));
    $book->setDescription($request->request->get('Description'));
    $book->setLinkToBuy($request->request->get('LinkToBuy'));
    $book->setAuthor($request->request->get('Author'));
    $book->setRank($request->request->get('Rank'));

    if($new) $em->persist($book);
    $em->flush();

    $response = new Response(json_encode(array('MSG' => '1')));
    $response->headers->set('Content-Type', 'application/json');
    return $response;

}






public function removeAction(Request $request)
{
	$isbn = $request->request->get('ISBN','NULL');
	if($isbn =='NULL')
	{
		$response = new Response(json_encode(array('MSG' => '-1')));
	}else{
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery('SELECT book.isbn FROM EnbabyDBManagerBundle:Books book WHERE book.isbn = :isbn')->setParameter('isbn', $isbn);
     $book = $query->getResult();

     if(!$book)
     {
       $response = new Response(json_encode(array('MSG' => '-1')));	
   }else{
       $query = $em->createQuery('DELETE FROM EnbabyDBManagerBundle:Books book WHERE book.isbn = :isbn')->setParameter('isbn',$isbn);
       $query->execute();
       $response = new Response(json_encode(array('MSG' => '1')));
   }
   $response->headers->set('Content-Type', 'application/json');
}
return $response;

}




public function snapshotuploadAction(Request $request)
{
    $isbn = $request->request->get('ISBN');
    $file = $request->request->get('File');
    $em = $this->getDoctrine()->getManager();
    $book = $em->getRepository('EnbabyDBManagerBundle:Books')->findOneByIsbn($isbn);
    $uploadedFile = WEBROOT . Uploads . $file;
    if($book && file_exists($uploadedFile))
    {
        $dest =SnapshotDB . $isbn . "_" . $file;
        copy($uploadedFile, WEBROOT . $dest);
        $book->setSnapshot($dest);
        $em->flush();
        $response = new Response(json_encode(array('MSG' => '1', 'Location' => $dest)));
    }else{
        $response = new Response(json_encode(array('MSG' => '-1')));
    }

    $response->headers->set('Content-Type', 'application/json');
    return $response;
}

public function audiouploadAction(Request $request)
{

    $isbn = $request->request->get('ISBN');
    $file = $request->request->get('File');
    $lang = $request->request->get('Lang','en');
    $em = $this->getDoctrine()->getManager();
    $book = $em->getRepository('EnbabyDBManagerBundle:Books')->findOneByIsbn($isbn);
    $uploadedFile = WEBROOT . Uploads . $file;
    if($book && file_exists($uploadedFile))
    {
        $dest = AudioDB . $isbn . "_" . $file;
        copy($uploadedFile, WEBROOT . $dest);
        if($lang == 'en')
        {
          if($book->getAudioFiles() == '')
          {
            $book->setAudioFiles($dest);
          }else{
            $audios = split(';',$book->getAudioFiles());
            array_push($audios, $dest);
            $book->setAudioFiles(join(';',$audios));
          }
          
        }else{
          if($book->getAudioFiles_cn() == '')
          {
            $book->setAudioFiles_cn($dest);
          }else{
            $audios = split(';',$book->getAudioFiles_cn());
            array_push($audios, $dest);
            $book->setAudioFiles_cn(join(';',$audios));
          }
          
        }
        
        $em->flush();
        $response = new Response(json_encode(array('MSG' => '1', 'Location' => $dest)));
    }else{
        $response = new Response(json_encode(array('MSG' => '-1')));
    }

    $response->headers->set('Content-Type', 'application/json');
    return $response;
}

public function audioremoveAction(Request $request)
{

    $isbn = $request->request->get('ISBN');
    $file = $request->request->get('remvoeLocation');
    $lang = $request->request->get('Lang','en');
    $em = $this->getDoctrine()->getManager();
    $book = $em->getRepository('EnbabyDBManagerBundle:Books')->findOneByIsbn($isbn);
    if($book)
    {
      if($lang == 'en')
      {
        $audios = split(';',$book->getAudioFiles());
        $newAudios = array();
        for($i = 0;$i<count($audios);$i++)
        {
            if($audios[$i] != $file && $audios[$i] != '')
            {
                array_push($newAudios,$audios[$i]);
            }
        }
        $book->setAudioFiles(join(';',$newAudios ));
      }else{
        $audios = split(';',$book->getAudioFiles_cn());
        $newAudios = array();
        for($i = 0;$i<count($audios);$i++)
        {
            if($audios[$i] != $file && $audios[$i] != '' )
            {
                array_push($newAudios,$audios[$i]);
            }
        }
        $book->setAudioFiles_cn(join(';',$newAudios ));
      }
        
        $em->flush();
        $response = new Response(json_encode(array('MSG' => '1')));
    }else{
        $response = new Response(json_encode(array('MSG' => '-1')));
    }
    $response->headers->set('Content-Type', 'application/json');
    return $response;
}
}
