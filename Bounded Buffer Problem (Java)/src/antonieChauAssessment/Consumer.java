package antonieChauAssessment;

/**
 * Consumer Class for Operating Systems Assessment
 * @author Antonie Chau 1305095
 */

import java.util.*;

public class Consumer implements Runnable {

    private Buffer sharedBuffer;

    public Consumer(Buffer sharedBuffer) {
       this.sharedBuffer = sharedBuffer;
    }
	
public void run() {
        
    long threadId = Thread.currentThread().getId();
    
    int i = 0;
    Random ran = new Random();
    
    while (true)
        {
            System.out.println("Consumer going to sleep");
            try
            {
                Thread.sleep(ran.nextInt(20000));
            } catch (Exception e)
                {
                    System.out.println("There was an error putting the consumer to sleep: " + e);
                }
            
            System.out.println("Retrieving Item");
            i = (sharedBuffer.removeItem());

            if (i > 0)
            {
                System.out.println("The buffer is empty");
            } else
            {
                System.out.println("Consumed number " + i + " Thread ID = " + threadId);
            }
        }
    }
}