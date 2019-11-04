<html xmlns = "http://www.w3.org/1999/xhtml">

  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title> ISP Term Project</title>
  </head>
  <body>
    	<div id="title"> <h1 align="center" style="margin-top:30px"> Take a Test </h1> </div>
    <div class="topnav" id="myTopnav">
      <a href="prj.html"> Home </a>
      <a href="main.html">Create a Test</a>
      <a href="selectTest.jsp" class="active">Take Test</a>
      <a href="viewGrades.html">View Grades</a>
      <%-- <a href="uploadDoc.html">Upload Documents</a> --%>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
    </div>
    <h2 style="margin-left:50px">Take a test</h2>
    <p style = "margin-left:50px">To begin, enter your student ID number (up to 7 numbers). If you are already in the system, <br>
      your score will be added to a list of previously taken test. Select the test you need to take from <br>
      the dropdown list and press submit. Once you complete the test, select submit and your grade will be displayed <br>
      and stored in your test table.
    </p>
    <p>
    <%@page import="java.sql.*"%>
    <%
          String qs;
          Statement stmt;
          Connection con;
          ResultSet rs;
          String error;

          Class.forName("com.mysql.jdbc.Driver").newInstance();
          try {
            con = DriverManager.getConnection("jdbc:mysql://db1.cs.uakron.edu:3306/ISP_jms590","jms590","Seattle2");
            stmt = con.createStatement(); // SQL statement object

            qs="select * from TestNames";
            rs=stmt.executeQuery(qs);

            out.println("<form action = 'takeTest.jsp' method = 'post'>");
            out.println("<p style = 'margin-left:50px'>Student ID Number: <input name='id' placeholder='1234567' size='8'>");
            out.println("<select style='margin-left:50px' name='TestNames'>");
            while(rs.next())
            {
            out.println("<option value='"+ rs.getString("TestName") + "'>" + rs.getString("TestName") + "</option>");
            }

            out.println("</select>");
            out.println("<input type='submit' value = 'submit'>");
            out.println("</form>");


          }
          catch (Exception e) {
          out.println(e.toString());  // Error message to display
          }
    %>
  </body>
</html>
