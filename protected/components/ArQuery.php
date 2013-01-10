<?php
// ----------------------------------------------------------------------
// Copyright (C) 2006 by Khaled Al-Shamaa.
// http://www.al-shamaa.com/
// ----------------------------------------------------------------------
// LICENSE

// This program is open source product; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.

// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Class Name: Arabic Queary Class
// Filename: oods.class.php
// Original  Author(s): Khaled Al-Sham'aa <khaled.alshamaa@gmail.com>
// Purpose:  Build WHERE condition for SQL statement using MySQL REGEXP and Arabic lexical  rules
// ----------------------------------------------------------------------

class ArQuery {
    private $fields = array();

    /**
    * @return TRUE if success, or FALSE if fail
    * @param Array $arrConfig Name of the fields that SQL statement will search them
    *                         (in array format where items are those fields names)
    * @desc setArrFields Setting value for $fields array
    * @author Khaled Al-Shamaa
    */
    public function setArrFields($arrConfig) {
        $flag = true;

        // Get fields array
        $this->fields = $arrConfig;

        // Error check!
        if(count($this->fields) == 0){ $flag = false; }

        return $flag;
    }

    /**
    * @return TRUE if success, or FALSE if fail
    * @param String $strConfig Name of the fields that SQL statement will search them
    *                         (in string format using comma as delimated)
    * @desc setStrFields Setting value for $fields array
    * @author Khaled Al-Shamaa
    */
    public function setStrFields($strConfig) {
        $flag = true;

        // Get fields array
        $this->fields = explode(",",$strConfig);

        // Error check!
        if(count($this->fields) == 0){ $flag = false; }

        return $flag;
    }

    /**
    * @return TRUE if success, or FALSE if fail
    * @param Integer $mode Setting value to be saved in the $mode propority
    * @desc setMode Setting $mode propority value that refer to search mode
    *               [0 for OR logic | 1 for AND logic]
    * @author Khaled Al-Shamaa
    */
    public function setMode($mode) {
        $flag = true;

        // Set search mode [0 for OR logic | 1 for AND logic]
        $this->mode = $mode;

        // Error check!
        if(!isset($this->mode)){ $flag = false; }

        return $flag;
    }

    /**
    * @return Integer Value of $mode properity
    * @desc getMode Getting $mode propority value that refer to search mode
    *               [0 for OR logic | 1 for AND logic]
    * @author Khaled Al-Shamaa
    */
    public function getMode() {
        // Get search mode value [0 for OR logic | 1 for AND logic]
        return $this->mode;
    }

    /**
    * @return Array Value of $fields array in Array format
    * @desc getArrFields Getting values of $fields Array in array format
    * @author Khaled Al-Shamaa
    */
    public function getArrFields() {
        $fields = $this->fields;

        return $fields;
    }

    /**
    * @return String Values of $fields array in String format (comma delimated)
    * @desc getStrFields Getting values of $fields array in String format (comma delimated)
    * @author Khaled Al-Shamaa
    */
    public function getStrFields() {
        $fields = implode(",", $this->fields);

        return $fields;
    }

    /**
    * @return String The WHERE section in SQL statement (MySQL database engine format)
    * @param String $arg  String that user search for in the database table
    * @desc getWhereCondition Build WHERE section of the SQL statement using defind lex's rules, 
                              search mode [AND | OR], and handle also phrases (inclosed by "") 
                              using normal LIKE condition to match it as it is.
    * @author Khaled Al-Shamaa
    */
    public function getWhereCondition($arg) {
        // Check if there are phrases in $arg should handle as it is
        $phrase = explode("\"", $arg);
        if (count($phrase)>2){
            // Re-init $arg variable (It will contain the rest of $arg except phrases).
            $arg = "";
            for($i=0; $i<count($phrase); $i++){
                if($i % 2 == 0 && $phrase[$i] != ""){
                   // Re-build $arg variable after restricting phrases
                   $arg .= $phrase[$i];
                }elseif($i % 2 == 1 && $phrase[$i] != ""){
                   // Handle phrases using reqular LIKE matching in MySQL
                   $this->wordCondition[] = $this->getWordLike($phrase[$i]);
                }
            }
        }

        // Handle normal $arg using lex's and regular expresion
        $words = explode(" ",$arg);

        foreach($words as $word){
            if($word != ""){ $this->wordCondition[] = $this->getWordRegExp($word); }
        }

        if($this->mode == 0){
           $sql = "(" . implode(") OR (", $this->wordCondition) . ")";
        }elseif($this->mode == 1){
           $sql = "(" . implode(") AND (", $this->wordCondition) . ")";
        }

        //$sql .= ' ORDER BY ' . $this->getOrderByRelevance($arg);

        return $sql;
    }

    /**
    * @return String sub SQL condition (for private use)
    * @param String $arg  String (one word) that you want to build a condition for
    * @desc getWordRegExp Search condition in SQL format for one word in all defind fields 
                          using REGEXP clause and lex's rules
    * @author Khaled Al-Shamaa
    */
    private function getWordRegExp($arg) {
        $arg = $this->lex($arg);
        $sql = "`" . implode("` REGEXP '$arg' OR `", $this->fields) . "` REGEXP '$arg'";

        return $sql;
    }

    /**
    * @return String sub SQL condition (for private use)
    * @param String $arg String (one word) that you want to build a condition for
    * @desc getWordRegExp Search condition in SQL format for one word in all defind fields using normal LIKE clause
    * @author Khaled Al-Shamaa
    */
    private function getWordLike($arg) {
        $sql = "`" . implode("` LIKE '$arg' OR `", $this->fields) . "` LIKE '$arg'";

        return $sql;
    }

      /**
       * @return String sub SQL ORDER BY section (for private use)
       * @param String $arg String that user search for in the database table
       * @desc Get more relevant order by section related to the user search keywords
       * @author Saleh AlMatrafe <saleh@saleh.cc>
       */
      private function getOrderByRelevance($arg)
      {
          // Check if there are phrases in $arg should handle as it is
          $phrase = explode("\"", $arg);
          if (count($phrase) > 2) {
              // Re-init $arg variable (It will contain the rest of $arg except phrases).
              $arg = '';
              for ($i = 0; $i < count($phrase); $i++) {
                  if ($i % 2 == 0 && $phrase[$i] != '') {
                      // Re-build $arg variable after restricting phrases
                      $arg .= $phrase[$i];
                  } elseif ($i % 2 == 1 && $phrase[$i] != '') {
                      // Handle phrases using reqular LIKE matching in MySQL
                      $wordOrder[] = $this->getWordLike($phrase[$i]);
                  }
              }
          }
          
          // Handle normal $arg using lex's and regular expresion
          $words = explode(' ', $arg);
          foreach ($words as $word) {
              if ($word != '') {
                  $wordOrder[] = 'CASE WHEN ' . $this->getWordRegExp($word) . ' THEN 1 ELSE 0 END';
              }
          }
          
          $order = '((' . implode(') + (', $wordOrder) . ')) DESC';

          return $order;
      }

    /**
    * @return String Regular Expression format to be used in MySQL query statement
    * @param String $arg  String of one word user want to search for
    * @desc Lex method will implement various regular expressin rules based on pre-defined Arabic lexical rules
    * @author Khaled Al-Shamaa
    */
    private function lex($arg) {
        $patterns = array();
        $replacements = array();

        // Prefix's
        array_push($patterns, '/^ال/'); array_push($replacements, '(ال)?');

        // Singular
        array_push($patterns, '/(\S{3,})تين$/'); array_push($replacements, '\\1(تين|ة)?');
        array_push($patterns, '/(\S{3,})ين$/'); array_push($replacements, '\\1(ين)?');
        array_push($patterns, '/(\S{3,})ون$/'); array_push($replacements, '\\1(ون)?');
        array_push($patterns, '/(\S{3,})ان$/'); array_push($replacements, '\\1(ان)?');
        array_push($patterns, '/(\S{3,})تا$/'); array_push($replacements, '\\1(تا)?');
        array_push($patterns, '/(\S{3,})ا$/'); array_push($replacements, '\\1(ا)?');
        array_push($patterns, '/(\S{3,})(ة|ات)$/'); array_push($replacements, '\\1(ة|ات)?');

        // Postfix's
        array_push($patterns, '/(\S{3,})هما$/'); array_push($replacements, '\\1(هما)?');
        array_push($patterns, '/(\S{3,})كما$/'); array_push($replacements, '\\1(كما)?');
        array_push($patterns, '/(\S{3,})ني$/'); array_push($replacements, '\\1(ني)?');
        array_push($patterns, '/(\S{3,})كم$/'); array_push($replacements, '\\1(كم)?');
        array_push($patterns, '/(\S{3,})تم$/'); array_push($replacements, '\\1(تم)?');
        array_push($patterns, '/(\S{3,})كن$/'); array_push($replacements, '\\1(كن)?');
        array_push($patterns, '/(\S{3,})تن$/'); array_push($replacements, '\\1(تن)?');
        array_push($patterns, '/(\S{3,})نا$/'); array_push($replacements, '\\1(نا)?');
        array_push($patterns, '/(\S{3,})ها$/'); array_push($replacements, '\\1(ها)?');
        array_push($patterns, '/(\S{3,})هم$/'); array_push($replacements, '\\1(هم)?');
        array_push($patterns, '/(\S{3,})هن$/'); array_push($replacements, '\\1(هن)?');
        array_push($patterns, '/(\S{3,})وا$/'); array_push($replacements, '\\1(وا)?');
        array_push($patterns, '/(\S{3,})ية$/'); array_push($replacements, '\\1(ي|ية)?');
        array_push($patterns, '/(\S{3,})ن$/'); array_push($replacements, '\\1(ن)?');

        // Writing errors
        array_push($patterns, '/(ة|ه)$/'); array_push($replacements, '(ة|ه)');
        array_push($patterns, '/(ة|ت)$/'); array_push($replacements, '(ة|ت)');
        array_push($patterns, '/(ي|ى)$/'); array_push($replacements, '(ي|ى)');
        array_push($patterns, '/(ا|ى)$/'); array_push($replacements, '(ا|ى)');
        array_push($patterns, '/(ئ|ىء|ؤ|وء|ء)/'); array_push($replacements, '(ئ|ىء|ؤ|وء|ء)');

        // Normalization
        array_push($patterns, '/ّ|َ|ً|ُ|ٌ|ِ|ٍ|ْ/'); array_push($replacements, '(ّ|َ|ً|ُ|ٌ|ِ|ٍ|ْ)?');
        array_push($patterns, '/ا|أ|إ|آ/'); array_push($replacements, '(ا|أ|إ|آ)');

       array_push($patterns, '/(عبد)/'); array_push($replacements, '(عبد |عبد)');
        
        
        $arg = preg_replace($patterns, $replacements, $arg);

        return $arg;
    }
}
?>
