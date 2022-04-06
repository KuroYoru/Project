<?php

$query = DB::select('select * from users_books');
$booksArray = array();
if ($result = $query) {
    $xml = new DOMDocument("1.0");
    $xml->formatOutput = true;
    $userbook = $xml->createElement("ownedbooks");
    $xml->appendChild($userbook);
    foreach ($query as $row) {
        $ownedbook = $xml->createElement("ownedbook");
        $userbook->appendChild($ownedbook);
        $rowArray = (array) $row;
        $userID = $xml->createElement("userID", $rowArray['userID']);
        $ownedbook->appendChild($userID);

        $bookID = $xml->createElement("bookID", $rowArray['bookID']);
        $ownedbook->appendChild($bookID);
    }
    $xml->save("ownedBook.xml");
    $xsl = new DOMDocument('1.0', 'UTF-8');
    $xsl->load("ownedBook.xsl");
    $xslt = new XSLTProcessor();
    $xslt->importStyleSheet($xsl);
    $xmldoc = new DOMDocument('1.0', 'UTF-8');
    $xmldoc->load("ownedBook.xml");
    print $xslt->transformToXML($xmldoc);
} else {
    echo "error";
    return redirect('book/books');
}