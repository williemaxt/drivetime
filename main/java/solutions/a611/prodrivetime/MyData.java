package solutions.a611.prodrivetime;

class MyData {
    private int id;
    private String client_email,client_name,business,details,amount_offered,driveremail,timestamp;



    public MyData(int id, String client_email, String client_name, String business, String details,
                  String amount_offered, String driveremail, String timestamp) {
        this.id = id;
        this.client_email = client_email;
        this.client_name = client_name;
        this.business = business;
        this.details = details;
        this.amount_offered = amount_offered;
        this.driveremail = driveremail;
        this.timestamp = timestamp;
    }

    public String getClient_email() {
        return client_email;
    }

    public void setClient_email(String client_email) {
        this.client_email = client_email;
    }

    public String getClient_name() {
        return client_name;
    }

    public void setClient_name(String client_name) {
        this.client_name = client_name;
    }

    public String getDriver_email() {
        return driveremail;
    }

    public void setDriver_email(String driver_email) {
        this.driveremail = driver_email;
    }

    public String getTimestamp() {
        return timestamp;
    }

    public void setTimestamp(String timestamp) {
        this.timestamp = timestamp;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getBusiness() {
        return business;
    }

    public void setBusiness(String business) {
        this.business = business;
    }

    public String getDetails() {
        return details;
    }

    public void setDetails(String details) {
        this.details = details;
    }

    public String getAmount_offered() {
        return amount_offered;
    }

    public void setAmount_offered(String amount_offered) {
        this.amount_offered = amount_offered;
    }
}
