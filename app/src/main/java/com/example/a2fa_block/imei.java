package com.example.a2fa_block;

import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Bundle;
import android.provider.Settings;
import android.telephony.TelephonyManager;
import android.util.Log;
import android.widget.TextView;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;


public class imei extends AppCompatActivity {

    @RequiresApi(api = Build.VERSION_CODES.O)
    String IMEINumber;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_imei);
        TextView td = (TextView) findViewById(R.id.imeino);
        TelephonyManager tm = (TelephonyManager) getSystemService(Context.TELEPHONY_SERVICE);

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            if (ActivityCompat.checkSelfPermission(imei.this, Manifest.permission.READ_PHONE_STATE) != PackageManager.PERMISSION_GRANTED) {
                return;
            }
//            try {
//                IMEINumber = tm.getImei();
//            } catch (NullPointerException e) {
//                IMEINumber = "";
//            }

            IMEINumber = Settings.Secure.getString(getContentResolver(), Settings.Secure.ANDROID_ID);
            Log.d("TAG", "UID: "+IMEINumber);

            td.setText(IMEINumber);
        }
    }
}