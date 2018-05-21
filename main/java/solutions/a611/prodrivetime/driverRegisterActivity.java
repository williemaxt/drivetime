package solutions.a611.prodrivetime;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

import javax.net.ssl.HttpsURLConnection;

public class driverRegisterActivity extends Activity {
Button button;
String name, email, number, password, confirmPassword, cdl, city, experience;
EditText Name, Email, Number, Password, ConfirmPassowrd, Cdl, City, Experience;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_driver_register);
        //setting the edit text views
        Name = findViewById(R.id.dname);
        Email = findViewById(R.id.demail);
        Number = findViewById(R.id.dnumber);
        Password = findViewById(R.id.dpw);
        ConfirmPassowrd = findViewById(R.id.dcpw);
        Cdl = findViewById(R.id.dcdl);
        City = findViewById(R.id.dcity);
        Experience = findViewById(R.id.dexperience);
        //button to submit
        button = (Button)findViewById(R.id.button);



        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //get the value of the fields
                password = Password.getText().toString();
                confirmPassword = ConfirmPassowrd.getText().toString();
                //check if passwords match
                if(confirmPassword.matches(password)){
                    //insert action
                    saveInfo();
                    Intent intent = new Intent(driverRegisterActivity.this, LoginActivity.class);
                    startActivity(intent);
                    finish();
                }else {
                    //toast a message
                    Toast.makeText(getApplicationContext(),"Please Match Your Password",Toast.LENGTH_LONG).show();
                }
            }
        });

    }
    //save the info
    public void saveInfo(){
        //pulling the data from fields and setting them to variables
        name = Name.getText().toString();
        email = Email.getText().toString();
        number = Number.getText().toString();
        password = Password.getText().toString();
        cdl = Cdl.getText().toString();
        city = City.getText().toString();
        experience = Experience.getText().toString();
        //these statements execute the background task we set below
        BackgroundTaskRegisterDriver backgroundTaskRegisterDriver = new BackgroundTaskRegisterDriver();
        backgroundTaskRegisterDriver.execute(name,email,number,password,cdl,city,experience);
    }

    //creating class for background task (send the data)
    class BackgroundTaskRegisterDriver extends AsyncTask<String, Void, String> {
        //this variable is to store our domain name
        String add_info_url;
        @Override
        protected void onPreExecute() {
            //this inserts our form url name into the variable
            add_info_url = "https://drivetime.000webhostapp.com/test/add_info.php";
        }

        @Override
        protected String doInBackground(String... args) {
            //decalring string variables
            String name,email,number,password,cdl,city,experience;
            //sets our strings as arguments
            name = args[0];
            email = args[1];
            number = args[2];
            password = args[3];
            cdl = args[4];
            city = args[5];
            experience = args[6];
            try {
                //trying to make a url variable and pass our string variable to it
                URL url = new URL(add_info_url);
                HttpsURLConnection httpsURLConnection = (HttpsURLConnection) url.openConnection();
                //similar to setting a PHP form method to post
                httpsURLConnection.setRequestMethod("POST");
                //allows us to send output from the app
                httpsURLConnection.setDoOutput(true);
                //setting output stream writer
                OutputStream outputStream = httpsURLConnection.getOutputStream();
                //this will label the format that we want to send the data in(UTF-8)
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream,"UTF-8"));
                //now we will encode the data into a string for each variable
                String data_string = URLEncoder.encode("name","UTF-8")+"="+URLEncoder.encode(name, "UTF-8")+"&"+
                        URLEncoder.encode("email","UTF-8")+"="+URLEncoder.encode(email, "UTF-8")+"&"+
                        URLEncoder.encode("number","UTF-8")+"="+URLEncoder.encode(number, "UTF-8")+"&"+
                        URLEncoder.encode("password","UTF-8")+"="+URLEncoder.encode(password, "UTF-8")+"&"+
                        URLEncoder.encode("cdl","UTF-8")+"="+URLEncoder.encode(cdl, "UTF-8")+"&"+
                        URLEncoder.encode("city","UTF-8")+"="+URLEncoder.encode(city, "UTF-8")+"&"+
                        URLEncoder.encode("experience","UTF-8")+"="+URLEncoder.encode(experience, "UTF-8");
                //Now we will write this data
                bufferedWriter.write(data_string);
                //now we close and flush our buffered writer
                bufferedWriter.flush();
                bufferedWriter.close();
                //close the remaining connections
                outputStream.close();
                InputStream inputStream = httpsURLConnection.getInputStream();
                inputStream.close();
                httpsURLConnection.disconnect();
                //return a string to show successful input
                return "Account Successfully Created!";


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
        protected void onPostExecute(String result) {
            //toast the return variable to show success of the request
            Toast.makeText(getApplicationContext(),result,Toast.LENGTH_LONG).show();
        }

    }
}
