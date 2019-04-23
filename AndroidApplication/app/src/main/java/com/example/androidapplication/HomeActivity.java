package com.example.androidapplication;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;


public class HomeActivity extends AppCompatActivity {

    Button profile;

    /**
     * Opens the home page of the app
     * @param savedInstanceState
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
    }

    /**
     *  Clicking the User Profile button will take you to the user profile
     * @param v
     */
    public void onButtonClickProfile(View v){
        Intent myIntent = new Intent(getBaseContext(), ProfileActivity.class);
        startActivity(myIntent);
    }

}
