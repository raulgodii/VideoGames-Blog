<?php
namespace Models;
use Repositories\EntryRepository;

class Entry {
    private EntryRepository $EntryRepository;
    public function __construct(){
        $this->EntryRepository = new EntryRepository();
    }

    public function getAll(): ?array{
        return  $this->EntryRepository->getAll();
    }
    
    public function saveEntry($newEntry):void{
        $this->EntryRepository->saveEntry($newEntry);
    }

    public function deleteEntry($idEntry){
        $this->EntryRepository->deleteEntry($idEntry);
    }

    public function updateEntry($updateEntry){
        $this->EntryRepository->updateEntry($updateEntry);
    }

    public function validateEntry($newEntry) {
        // Validate title
        if (!isset($newEntry['title']) || !is_string($newEntry['title'])) {
            return false;
        }
    
        $trimmedTitle = trim($newEntry['title']);
    
        // Valid Length for title
        $minTitleLength = 3;
        $maxTitleLength = 100;
        if (strlen($trimmedTitle) < $minTitleLength || strlen($trimmedTitle) > $maxTitleLength) {
            return false; 
        }
    
        // Valid Characters for title
        if (preg_match('/[\'";]/', $trimmedTitle)) {
            return false;
        }
    
        // Validate description
        if (!isset($newEntry['description']) || !is_string($newEntry['description'])) {
            return false;
        }
    
        $trimmedDescription = trim($newEntry['description']);
    
        // Valid Length for description
        $minDescriptionLength = 5;
        $maxDescriptionLength = 500; 
        if (strlen($trimmedDescription) < $minDescriptionLength || strlen($trimmedDescription) > $maxDescriptionLength) {
            return false; 
        }
    
        // Valid Characters for description
        if (preg_match('/[\'";]/', $trimmedDescription)) {
            return false;
        }
    
        // Validate category_id
        if (!isset($newEntry['category_id']) || !is_numeric($newEntry['category_id'])) {
            return false;
        }
    
        return true;  // All fields are valid
    }    

    public function sanitizeEntry(array $newEntry) {
        $sanitizedEntry = [];
    
        foreach ($newEntry as $key => $value) {
            // Sanitize each field using htmlspecialchars
            $sanitizedEntry[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    
        return $sanitizedEntry;
    }
    
}
