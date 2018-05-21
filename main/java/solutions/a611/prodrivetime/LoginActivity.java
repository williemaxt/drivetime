package solutions.a611.prodrivetime;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Intent;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

import javax.net.ssl.HttpsURLConnection;

/**
 * A login screen that offers login via email/password.
 */
public class LoginActivity extends Activity {
    public String json_string;
    public static String driver__name,driver__email,driver__number,driver__city,driver__experience = "" ;
    // UI references.
     AutoCompleteTextView ET_NAME;
     EditText ET_PASS;
     String login_name, login_pass;
     ProgressBar mProgressView;
     CardView loginCard;

    Button driverRegister;
    Button login;
    Button forgotPass;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        //declaring the cardview
        loginCard = (CardView) findViewById(R.id.login_card);

        //declaring the progressbar
        mProgressView = (ProgressBar) findViewById(R.id.progressBar);

        //set visibility of the progress bar
        mProgressView.setVisibility(View.INVISIBLE);

        // Set up the login form.
        ET_NAME = (AutoCompleteTextView) findViewById(R.id.user_name);
        ET_PASS = (EditText) findViewById(R.id.user_pass);

        //USER REGISTER
        driverRegister = (Button) findViewById(R.id.RegisterBtn);
        forgotPass = (Button) findViewById(R.id.forgotPass);

        //switch to driver register
        driverRegister.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(LoginActivity.this, driverRegisterActivity.class);
                startActivity(intent);
            }
        });

        //LOGIN BUTTON
        login = (Button) findViewById(R.id.email_sign_in_button);
        login.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                userLogin();
                mProgressView.setVisibility(View.VISIBLE);
                //set the visibility of the cardview
                loginCard.setVisibility(View.INVISIBLE);

            }
        });
        //FORGOT PASWORD
        forgotPass.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });

    }
    //USER LOGIN
    public void userLogin(){
        //GETTING DATA FROM FIELDS
        login_name = ET_NAME.getText().toString();
        login_pass = ET_PASS.getText().toString();
        //CREATING BACKGROUND TASK
        BackgroundTaskLoginDriver backgroundTaskLoginDriver = new BackgroundTaskLoginDriver();
        backgroundTaskLoginDriver.execute(login_name,login_pass);

    }

    class BackgroundTaskLoginDriver extends AsyncTask<String, Void, String> {
        //this variable is to store our domain name
        String login_url;
        //initializing an alert dialog
        AlertDialog alertDialog;
        @Override
        protected void onPreExecute() {
            //this inserts our form url name into the variable
            login_url = "https://drivetimepro1.000webhostapp.com/apps/android/loginDriver.php";
            //this alert dialog will show after they login
            alertDialog = new AlertDialog.Builder(getApplicationContext()).create();
            alertDialog.setTitle("Login Information");
        }

        @Override
        public String doInBackground(String... args) {
            //decalring string variables
            String name,email,number,password,cdl,city,experience;
            //sets our strings as arguments
            login_name = args[0];
            login_pass = args[1];

            try {
                //trying to make a url variable and pass our string variable to it
                URL url = new URL(login_url);
                HttpsURLConnection httpsURLConnection = (HttpsURLConnection) url.openConnection();
                //similar to setting a PHP form method to post
                httpsURLConnection.setRequestMethod("POST");
                //allows us to send output from the app
                httpsURLConnection.setDoOutput(true);
                //allows us to receive input from the app
                httpsURLConnection.setDoInput(true);
                //setting output stream writer
                OutputStream outputStream = httpsURLConnection.getOutputStream();
                //this will label the format that we want to send the data in(UTF-8)
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream,"UTF-8"));
                //now we will encode the data into a string for each variable
                String data_string =
                        URLEncoder.encode("login_name","UTF-8")+"="+URLEncoder.encode(login_name, "UTF-8")+"&"+
                        URLEncoder.encode("login_pass","UTF-8")+"="+URLEncoder.encode(login_pass, "UTF-8");
                //Now we will write this data
                bufferedWriter.write(data_string);
                //now we close and flush our buffered writer
                bufferedWriter.flush();
                bufferedWriter.close();
                //close the output stream
                outputStream.close();
                //establish input stream
                InputStream inputStream = httpsURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream,"iso-8859-1"));
                String response = "";
                String line = "";
                while((line = bufferedReader.readLine()) != null){
                    response+= line;
                }
                bufferedReader.close();
                inputStream.close();
                httpsURLConnection.disconnect();
                //return a string to show successful input
                System.out.println(response);
                return response;

                //catching exceptions
            }catch (MalformedURLException e){
                e.printStackTrace();
            }
            catch (IOException e){
                //will print out the exception if we have one
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }

        @Override
        public void onPostExecute(String response) {
            json_string = response;
            try {
                JSONArray driver = new JSONArray(response);

                //looping through the data from the JSON array
                for(int i = 0; i < driver.length(); i++){
                    //declaring the JSON Object
                    JSONObject object = driver.getJSONObject(i);

                    //these values will be stored in the static variables for later use
                    driver__name = (object.getString("name"));
                    driver__email = (object.getString("email"));
                    driver__number = (object.getString("number"));
                    driver__city = (object.getString("city"));
                    driver__experience = (object.getString("experience"));
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }

            //making the progressbar invisible
            mProgressView.setVisibility(View.INVISIBLE);

            Intent intent = new Intent(LoginActivity.this, DriverActivity.class);
            startActivity(intent);

        }


    }

}