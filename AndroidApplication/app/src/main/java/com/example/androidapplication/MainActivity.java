package com.example.androidapplication;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.content.Intent;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class MainActivity extends AppCompatActivity {

    EditText username;
    Button loginbutton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        System.out.println("Login Screen");
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

    }

    // Opens the home page of the app from the Login screen by pressing the login button
    // what you input into the login screen doesn't matter as this app isn't connected to a DB
    public void onButtonClick(View v){
        Intent myIntent = new Intent(getBaseContext(), HomeActivity.class);
        startActivity(myIntent);
    }

    // opens the register screen by pressing the Register button on the login screen
    public void onButtonClick2(View v){
        Intent myIntent = new Intent(getBaseContext(), RegisterActivity.class);
        startActivity(myIntent);
    }

}
