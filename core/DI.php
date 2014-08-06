<?php
/**
 * Description of DI
 *
 * @author fkairu
 */
include_once ABSOLUTEURL .'/models/FreqHistoryTable.php';
include_once ABSOLUTEURL .'/models/FreqHistory.php';
include_once ABSOLUTEURL.'/models/FrequenciesTable.php';
include_once ABSOLUTEURL.'/models/Frequencies.php';
include_once ABSOLUTEURL.'/models/MediaTable.php';
include_once ABSOLUTEURL.'/models/Media.php';
include_once ABSOLUTEURL.'/models/MessageTable.php';
include_once ABSOLUTEURL.'/models/Message.php';
include_once ABSOLUTEURL.'/models/MessageAttachmentsTable.php';
include_once ABSOLUTEURL.'/models/MessageAttachments.php';
include_once ABSOLUTEURL.'/models/MsgFrequenciesTable.php';
include_once ABSOLUTEURL.'/models/MsgFrequencies.php';
include_once ABSOLUTEURL.'/models/QueuesTable.php';
include_once ABSOLUTEURL.'/models/Queues.php';
include_once ABSOLUTEURL.'/models/RecepientsTable.php';
include_once ABSOLUTEURL.'/models/RecepientType.php';
include_once ABSOLUTEURL.'/models/RecepientType.php';
include_once ABSOLUTEURL.'/models/Recepients.php';
include_once ABSOLUTEURL.'/models/SentHistoryTable.php';
include_once ABSOLUTEURL.'/models/SentHistory.php';
include_once ABSOLUTEURL.'/models/SysModulesTable.php';
include_once ABSOLUTEURL.'/models/SysModules.php';



class DI {
    
public  static function getClassInstance($classname){
    switch ($classname) {
            case "FrequencyHistoryTable":return new FreqHistoryTable(); //return an instance of Frequency history table
               case "FrequencyHistory":return new FreqHistory(); //return an instance of Frequency history 
            
            case "FrequenciesTable":return new FrequenciesTable(); //return an instance of Frequencies Table
            
            case "Frequencies":return new Frequencies(); //return an instance of Frequencies Table
            
            case "MediaTable":return new MediaTable(); //return an instance of Media table
            
            case "Media":return new Media(); 
            
            case "MessageTable":return new MessageTable();  //return an instance of MessageTable
           
            case "Message":return new Message();  //return an instance of Message model
            
            case "MessageFrequenciesTable":return new MsgFrequenciesTable();  //return an instance of MsgFrequenciesTable
            
            case "MessageFrequencies":return new MsgFrequencies();  
              
             case "MessageAttachmentsTable":return new MessageAttachmentsTable();  //return an instance of MsgFrequenciesTable
            
            case "MessageAttachments":return new MessageAttachments();  
            
            case "QueuesTable":return new QueuesTable(); 
            
            case "Queues":return new Queues(); //Queues model
            
            case "RecepientsTable":return new RecepientsTable(); 
            
            case "RecepientType":return new RecepientType(); //recepients model
            
            case "RecepientTypeTable":return new RecepientTypeTable(); 
            
            case "Recepients":return new Recepients(); //recepients model
            case "SentHistoryTable":return new SentHistoryTable(); 
            
            case "SentHistory":return new SentHistory(); 
            
            case "SysModulesTable":return new SysModulesTable(); 
            
          case "SysModules":return new SysModules(); 
            
        
        
        
        default:
            die("no model named ".$classname);
           break; 
    }
     
    
}
}
