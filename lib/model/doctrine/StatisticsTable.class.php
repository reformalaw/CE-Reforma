<?php

/**
 * StatisticsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class StatisticsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object StatisticsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Statistics');
    }

    /**
     * This function is use for add the ip at statistics table
     *
     * @param unknown_type $ip
     * @param unknown_type $host
     */
    public static function addIpToStatistics($ip, $websiteId){
//         $ipFlag = self::getCheckIpExist($ip, $websiteId);
//         if ($ipFlag == false) {   commented by jaydip dodiya for remove the ip address entry
        #$website = Doctrine_Core::getTable('UsersWebsite')->findOneByWebsiteURL($host);
        $objIp = new Statistics();
        $objIp->setWebsiteId($websiteId);
        $objIp->setIpAddress($ip);
        $objIp->setVisitDate(date('Y-m-d'));
        $objIp->save();
//         }
    }

    /**
     * This function is use for check the ip as well as current date.
     *
     * @param unknown_type $ip
     * @return unknown
     */
    public static function getCheckIpExist($ip, $websiteId)
    {
        $dbIp = Doctrine_Query::create()
        ->from('Statistics s')
        ->where('s.IpAddress = ?', $ip)
        ->andWhere('s.WebsiteId = ?', $websiteId)
        ->andWhere('s.VisitDate = ?', date('Y-m-d'));
        
        $resultIp = $dbIp->fetchArray();
        $dbIp->free();
        if (count($resultIp) == 1) {
            return true;
        }else {
            return false;
        }
    }

    /**
    * This Function is use for get date interval from current date
    * @ param string $BtnDay
    * @ return array 
    */
    public static function getDaysStatistics($webId="", $BtnDay = '1' , $DayType = 'DAY')
    {
        //echo $start_date = date('Y-m-d',strtotime('- 1 month')); exit; 
        $start_date = date('Y-m-d',strtotime('-'.$BtnDay.$DayType));  // Get Start date
        $end_date   = date('y-m-d');                     // Get Current date

        $sql = Doctrine_Query::create()
                ->select('s.*,count(*) AS TotalVisit')
                ->from('Statistics s')
                ->where('s.VisitDate BETWEEN ? AND ?', array($start_date,$end_date));

                if($webId != "")
					$sql->andWhere('s.WebsiteId = ?', $webId);
				else
					 $sql->whereNotIn('s.WebsiteId', array(1,2));
					

		$sql->groupBy('s.VisitDate');

        $sqlResult =$sql->fetchArray();

        //clsCommon::pr($sqlResult,1);
        return $sqlResult;

    }
}