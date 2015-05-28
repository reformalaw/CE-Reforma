
<?php

/**
 * StatesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class StatesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object StatesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('States');
    }

    public static function getUSStatesData(){

        $sql = Doctrine_Query::create()
        ->select('s.Id, s.Name')
        ->from('States s')
        ->where('s.Status = ? ', sfConfig::get('app_UserStatus_Active') )
        ->andWhere('s.CountryId = ?', sfConfig::get('app_State_UsStateId'))
        ->orderBy('s.Name ASC');

        $result = $sql->fetchArray();
        #clsCommon::pr($result);

        $stateArr = array();
        foreach ($result as $value ){
            $stateArr[$value['Id']] = $value['Name'];
        }

        #clsCommon::pr($stateArr);exit;
        $sql->free();
        return $stateArr;
    }

    /**
     * Function to check name exist or not
     *
     * @param string $ssName
     */
    public static function checkUniqueName($ssName)
    {
        if(!is_string($ssName))
        return false;

        $asResult = Doctrine_Query::create()
        ->select("S.*")
        ->from('States S')
        ->where("S.Name = ?", $ssName)
        ->fetchArray();

        return $asResult;
    }

    /**
     * Function to Get State Country in Tree
     *
     * @return unknown
     */
    public static function getStateList()
    {
        #THIS QUERY IS GET THE DATA OF PARENT ONLY.
        $sql = Doctrine_Query::create()
        ->select('s.Id, s.Name')
        ->from('States s')
        ->where('s.Status = ? ', sfConfig::get('app_UserStatus_Active') )
        ->andWhere('s.CountryId = ?', sfConfig::get('app_State_UsStateId'))
        ->orderBy('s.Name ASC');
        $arrSectors = $sql->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
        #clsCommon::pr($arrSectors,1);
        if(!empty($arrSectors)) {

            /*$arrTreeSectors = array(
            -1 => array('label'=>'Parent Category','children'=>array()),
            );
            $arrTreeSectors[-1]['children'][1] = array('label'=>'One');
            $arrTreeSectors[-1]['children'][2] = array('label'=>'two');



            $arrTreeSectors[-1]['children'][1]['children'][3] = array('label'=>'three');
            $arrTreeSectors[-1]['children'][1]['children'][4] = array('label'=>'four');*/


            $arrTreeSectors = array(
            -1 => array('label'=>'All Category','children'=>array()),
            );
            for ($i = 0;$i<count($arrSectors);$i++){
                if (isset($arrSectors[$i]['Id'])) {
                    # HERE WE ARE ASSING THE VALUE IN ARRAY.
                    $level0 = $arrSectors[$i]['Id']."-0"; # here we define level 0 with value.

                    if (!isset($arrTreeSectors[-1]['children'][$level0]['label'])) {
                        $arrTreeSectors[-1]['children'][$level0]['label'] = $arrSectors[$i]['Name'];
                    }
                    if (!isset($arrTreeSectors[-1]['children'][$level0]['children'])) {
                        $arrTreeSectors[-1]['children'][$level0]['children'] = array();
                    }
                    #THIS QUERY IS USE TO GET THE CHILD ON THE BASIS OF ABOVE PARENT ID.
                    $sql2 = Doctrine_Query::create()
                    ->select('c.Id,  c.Name')
                    ->from('Counties c')
                    ->where('c.StateId  = ?',$arrSectors[$i]['Id'])
                    ->andWhere('c.Status = ?',sfConfig::get('app_Status_Active'))
                    ->orderBy('c.Name ASC');
                    $arrChildList = $sql2->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
                    if (!empty($arrChildList)) {
                        for ($j =0;$j<count($arrChildList);$j++){
                            if (isset($arrChildList[$j]['Id'])) {
                                # HERE WE ARE ASSING THE CHILD VALUE IN ARRAY.
                                $level1 = $arrChildList[$j]['Id']."-1"; # here we define level 1 with value

                                if (!isset($arrTreeSectors[-1]['children'][$level1]['label'])) {
                                    $arrTreeSectors[-1]['children'][$level0]['children'][$level1]['label'] = $arrChildList[$j]['Name'];
                                }
                                if (!isset($arrTreeSectors[-1]['children'][$level1]['children'])) {
                                    $arrTreeSectors[-1]['children'][$level0]['children'][$level1]['children'] = array();
                                }

                                #THIS QUERY IS USE TO GET THE SUB-CHILD ON THE ABOVE BASIS OF PARENT ID.
                                /*$sql3 = Doctrine_Query::create()
                                ->select('pa.Id, pa.ParentId, pa.Name')
                                ->from('PracticeAreas pa')
                                ->where('pa.ParentId = ?',$arrChildList[$j]['Id'])
                                ->andWhere('pa.Status = ?',sfConfig::get('app_Status_Active'))
                                ->orderBy('pa.Name ASC');
                                $arrSubChildList = $sql3->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

                                if (!empty($arrSubChildList)) {
                                for ($p=0;$p<count($arrSubChildList);$p++){
                                if (isset($arrSubChildList[$p]['ParentId'])) {
                                # HERE WE ARE ASSING THE SUB-CHILD VALUE IN ARRAY.
                                $level2 = $arrSubChildList[$p]['Id']."-2"; #Here we define level 2 with value
                                if (!isset($arrTreeSectors[-1]['children'][$level0]['children'][$level1]['children'][$level2]['label'])) {
                                $arrTreeSectors[-1]['children'][$level0]['children'][$level1]['children'][$level2]['label'] = $arrSubChildList[$p]['Name'];
                                }
                                if (!isset($arrTreeSectors[-1]['children'][$level2]['children'])) {
                                $arrTreeSectors[-1]['children'][$level0]['children'][$level1]['children'][$level2]['children'] = array();
                                }

                                }else {
                                $arrTreeSectors[-1]['children'][$arrSubChildList[$p]['ParentId']]['children'][$level0]['children'][$level1]['children'][$level2] = array('label'=>$arrSubChildList[$p]['Name']);
                                }

                                }
                                }*/
                            }else {
                                $arrTreeSectors[-1]['children'][$arrChildList[$j]['Id']]['children'][$level0]['children'][$level1] = array('label'=>$arrChildList[$j]['Name']);
                            }

                        }
                    }
                }else {
                    $arrTreeSectors[-1]['children'][$arrSectors[$i]['Id']]['children'][$level0] = array('label'=>$arrSectors[$i]['Name']);
                }
                //clsCommon::pr($arrTreeSectors,1);
            }

            #clsCommon::pr($arrTreeSectors,1);
            return $arrTreeSectors;
        } else {
            return false;
        }
    }


}