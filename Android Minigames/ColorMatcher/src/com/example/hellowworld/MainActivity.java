package com.example.hellowworld;

import java.util.Random;

import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;



public class MainActivity extends ActionBarActivity {

	
	int currentScore = 0;
	int highScore = 0;

	
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //Sets the view to the Color Matcher GUI
        setContentView(R.layout.activity_main);
        
        TextView text = (TextView) findViewById(R.id.textView1);
        TextView score = (TextView) findViewById(R.id.textView3);
        TextView highscore = (TextView) findViewById(R.id.textView4);
        
        //Randomizes the text and color of textView
        text.setText(randomizeText());
        score.setText(String.valueOf(currentScore));
        highscore.setText("Highscore: " + String.valueOf(highScore));
        randomizeColor();
       
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        if (id == R.id.action_settings) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }
    
    
    public String randomizeText(){
    	
    	//Default output. If you get Black, you know something is wrong
    	String output = "Black";
    	//Array containing colors to randomly choose from
    	String colours[] ={"Red", "Green", "Blue"};
        Random r = new Random();
        
        int n = r.nextInt(3);        
        output = (colours[n]);
    	
    	return output;
    }
    
    public void randomizeColor(){ 
    	
    	TextView text = (TextView) findViewById(R.id.textView1);  
        Random r = new Random();       
        int n = r.nextInt(3);
        
        if(n== 1)
        	text.setTextColor(Color.RED);
        else if(n==2)
        	text.setTextColor(Color.GREEN);
        else
            text.setTextColor(Color.BLUE);
        
       
    } 
    
    
    //Update method which is called after each button press
    public void update(){
    	TextView text = (TextView) findViewById(R.id.textView1);
    	TextView score = (TextView) findViewById(R.id.textView3);
    	TextView highscore = (TextView) findViewById(R.id.textView4);    	
 
    	text.setText(randomizeText());
    	score.setText(String.valueOf(currentScore));
    	updateHighscore(currentScore);
    	highscore.setText("Highscore: " + String.valueOf(highScore));    	
    	    	
        randomizeColor();
        
    }
    
    //Method to reset the game after a game over
    //Simply calls the update method again. Once scoring is implemented, this method needs to reset the score and timer to 0
    public void resetGame(View view){
    	currentScore = 0;
    	update();    	
    }
    
    //Sets the textView1 to Game Over and makes the font black. Tap/Click restart to try again.
    //Basically just for show and to implement more functionality later
    public void gameOver(){
    	TextView text = (TextView) findViewById(R.id.textView1);  
    	text.setText("Game Over");
    	text.setTextColor(Color.BLACK);
    }
    
    public void updateHighscore(int n){
    	if(n >= highScore){
    		highScore = n;
    	}    	
    }
    
    //Methods to check if the right button has been pressed. Can probably optimize this code once I'm more familiar with eclipse
    public void checkAnswerRed(View view){
    	String answer = "Red";
    	if(verify(answer)){
    		currentScore +=1;    		
    		update();
    	}
    	else
    		gameOver();   	
    }
    
    public void checkAnswerGreen(View view){
    	String answer = "Green";
    	if(verify(answer)){    		
    		currentScore +=1;
    		update();
    	}
    	else    		
    		gameOver();
    	
    }
    
    public void checkAnswerBlue(View view){
    	String answer = "Blue";
    	if(verify(answer)){
    		currentScore +=1;
    		update();
    	}
    	
    	else    		
    		gameOver();
    	
    }    
    
    //Pulls the String value from textView1 and compares it to the button pressed.
    public boolean verify(String option){
    	TextView text = (TextView) findViewById(R.id.textView1);
        boolean correct = false;    
        String answer = text.getText().toString();
        if(option == answer)
          correct = true;
        else
          correct = false;
        
        return correct;
       
    }    

    
    
}
