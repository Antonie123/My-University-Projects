package antonieChauAssessment;

import java.util.concurrent.Semaphore;

/**
 * Buffer Class for Operating Systems Assessment
 * @author Antonie Chau 1305095
 */

public class Buffer{
    
    //Intialising semaphores in constructor
    private Semaphore empty;
    private Semaphore full;
    private Semaphore mutex;	
	
    //more private fields such as a container object for holding the buffer items
    private static final int BUFFER_SIZE = 5;
    private int count;
    private int input;
    private int output;
    private final Object[] buffer;
    private int result;
	
	
    public Buffer() {
        
        //Initialise values to zero.
        count = 0;
        input = 0;
        output = 0;
        result = -1;
		
	//Initialise buffer to given Buffer size
        buffer = new Object[BUFFER_SIZE];
		
	//Initialise Semaphores
        mutex = new Semaphore(1);
        empty = new Semaphore(BUFFER_SIZE);
        full = new Semaphore(0);
    }
    
    //Inserts the item into the buffer
    public int insertItem(Object item) {       
        
	while (count == BUFFER_SIZE)
            {
		//Do nothing, since the buffer array is full.
            }
		
        //Acquire the Semaphores
        try
            {
            empty.acquire();
            mutex.acquire();
            } 
		catch (Exception e)
        {
            System.out.println("There was an error perfroming insert(): " + e);
        }

        //insert the item 
        ++count;
        buffer[input] = item;
        input = (input + 1) % BUFFER_SIZE;

        if (count >= BUFFER_SIZE)
            {
            System.out.println("The buffer is full. Producer inserted an Item; " 
                + "count now = " + count + ", " + "input = " + input + ", output = " + output);
            result = -1;
            } else
        {
            System.out.println("Producer inserted an Item; count now = " + count 
                + ", " + "input = " + input + ", output = " + output);
            result = 0;
        }
		
        //Release both semaphores
        mutex.release();
        full.release();
        return result;
    }
    
    public int removeItem() {
        
	while (count == 0)
            {
            //Do nothing, since the buffer array is empty.
            }
		
	//Acquire the Semaphores
        try
            {
            full.acquire();
            mutex.acquire();
            } 
		catch (Exception e)
        {
            System.out.println("There was an error perfroming remove(): " + e);
        }
		
        //remove the item 
            --count;         
            output = (output + 1) % BUFFER_SIZE;
	
        if (count == 0)
            {
            System.out.println("The Buffer is empty. Consumer consumed Item; " 
                + "count now = " + count + ", input = " + input + ", output = " + output);
            result = -1;
            } else
            {
            System.out.println("Consumer consumed Item; count now = " + count 
                + ", input = " + input + ", output = " + output);
            result = 0;
            }
		
        //release semaphores
        mutex.release();
        empty.release();   
        
        return result;
    }
}    
