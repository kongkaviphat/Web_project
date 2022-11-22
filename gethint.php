<?php
// Array with names
$a[] = "Anna";
$a[] = "Alex";
$a[] = "Brian";
$a[] = "Jack";
$a[] = "Poul";
$a[] = "Peter";
$a[] = "Harry";
$a[] = "Ron";
$a[] = "Hermione";
$a[] = "Albus";
$a[] = "Sirius";
$a[] = "Remus";
$a[] = "James";
$a[] = "Lily";
$a[] = "Dumbledore";
$a[] = "Snape";
$a[] = "Voldemort";
$a[] = "Draco";
$a[] = "Hagrid";
$a[] = "Fred";
$a[] = "George";
$a[] = "Neville";
$a[] = "Ginny";
$a[] = "Cho";
$a[] = "Luna";
$a[] = "Seamus";
$a[] = "Dean";
$a[] = "Severus";
$a[] = "Minerva";
$a[] = "Filius";
$a[] = "Alastor";
$a[] = "Bellatrix"; 
$a[] = "Lucius";
$a[] = "Narcissa";
$a[] = "Rubeus";
$a[] = "Dolores";
$a[] = "Gilderoy";
$a[] = "Horace";
$a[] = "Igor";
$a[] = "Kingsley";
$a[] = "Lavender";
$a[] = "Millicent";
$a[] = "Molly";
$a[] = "Brittany";
$a[] = "Cinderella";
$a[] = "Diana";
$a[] = "Eva";
$a[] = "Fiona";
$a[] = "Gunda";
$a[] = "Hege";
$a[] = "Inga";
$a[] = "Johanna";
$a[] = "Kitty";
$a[] = "Linda";
$a[] = "Nina";
$a[] = "Ophelia";
$a[] = "Petunia";
$a[] = "Amanda";
$a[] = "Raquel";
$a[] = "Cindy";
$a[] = "Doris";
$a[] = "Eve";
$a[] = "Evita";
$a[] = "Sunniva";
$a[] = "Tove";
$a[] = "Unni";
$a[] = "Violet";
$a[] = "Liza";
$a[] = "Elizabeth";
$a[] = "Ellen";
$a[] = "Wenche";
$a[] = "Vicky";
$a[] = "กัญญา";
$a[] = "กันยา";
$a[] = "กาญจนา";
$a[] = "ขวัญ";
$a[] = "ขวัญชัย";
$a[] = "ขวัญศิริ";
$a[] = "ขวัญศุภา";
$a[] = "คณิต";
$a[] = "คณิตา";
$a[] = "คนธรรม";
$a[] = "คนธรรมา";

$q = $_REQUEST["q"];

$hint = "";

if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}

echo $hint === "" ? "ไม่มีคำแนะนำ :" : $hint;
?>
