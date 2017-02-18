package antonieChauAssessment;

/**
 * Producer Class for Operating Systems Assessment
 * @author Antonie Chau 1305095
 */

import java.util.*;

public class Producer implements Runnable {

    private Buffer sharedBuffer;
    
    public Producer(Buffer sharedBuffer) {        
        this.sharedBuffer = sharedBuffer;
    }

public void run() {
        
    long threadId = Thread.currentThread().getId();
    int i = 0;
    Random ran = new Random();
    
    while (true)
        {
        System.out.println("Producer going to sleep");
        try
        {
           Thread.sleep(ran.nextInt(1000));
        } catch (Exception e)
            {
                System.out.println("There was an error putting the producer to sleep: " + e);
            }
            
	i = ran.nextInt(100);
        
            sharedBuffer.insertItem(i);
            System.out.println("Produced number " + i + " Thread ID = " + threadId);
            
        }
    }
}