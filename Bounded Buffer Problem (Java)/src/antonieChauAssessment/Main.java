package antonieChauAssessment;

import static java.lang.Integer.parseInt;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Main Class for Operating Systems Assessment
 * @author Antonie Chau 1305095
 */
public class Main {

    public static void main(String[] args) {

        //multiple producer/consumer threads need to be created based on input parameters
        int sleepTime = parseInt(args[0]);
        //int producerThreads = parseInt(args[1]);
	//int consumerThreads = parseInt(args[2]);
        
		
	//Initialise buffer
        Buffer sharedBuffer = new Buffer();
		
	//Create producer/consumer threads

        Thread producer1 = new Thread(new Producer(sharedBuffer));  
        Thread consumer1 = new Thread(new Consumer(sharedBuffer));     
		
	//Start producer/consumer threads.
        producer1.start();
        consumer1.start();
        
        try {
            //Code to put the thead to sleep
            Thread.sleep(sleepTime);
            } catch (Exception e)
            {
                System.out.println("There was an error putting main thread to sleep: " + e);
            }
        //This code then ends the program
        System.exit(0);
    }
	
}

