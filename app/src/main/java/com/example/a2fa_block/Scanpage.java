package com.example.a2fa_block;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

public class Scanpage extends AppCompatActivity {

    public static TextView tvresult;
    Button im,sc;
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_scanpage);
        im= (Button) findViewById(R.id.imei);
        sc= (Button) findViewById(R.id.scan);
        tvresult = (TextView) findViewById(R.id.tvresult);

        sc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent s=new Intent(Scanpage.this,qrpage.class);
                startActivity(s);
            }
        });

        im.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i= new Intent(Scanpage.this, imei.class);
                startActivity(i);
            }

    });

}
}