package com.example.messagereportermodule;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.telephony.SmsMessage;


public class MyReceiver extends BroadcastReceiver {


    private static MessageListener mListener;

    @Override
    public void onReceive(Context context, Intent intent) {

        Bundle data = intent.getExtras();
        Object[] pdus = (Object[]) data.get("pdus");
        for (int i = 0; i < pdus.length; i++) {
            SmsMessage smsMessage = SmsMessage.createFromPdu((byte[]) pdus[i]);
            //String message = "Sender : " + smsMessage.getDisplayOriginatingAddress()
             //                 + "\nMessage: " + smsMessage.getMessageBody();
            String message = smsMessage.getMessageBody();
                    String msg_from = smsMessage.getOriginatingAddress();
                    mListener.messageReceived(message,msg_from);
        }
    }
    public static void bindListener(MessageListener listener) {
        mListener = listener;
    }
}