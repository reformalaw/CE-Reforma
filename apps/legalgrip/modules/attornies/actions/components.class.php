<?php
class attorniesComponents extends sfComponents {

    public function executeTopProfessionals(sfWebRequest $request) {

        $this->topProfessionalsArr = UsersTable::getTopProfessionals();

    } // End of Function

}


?>