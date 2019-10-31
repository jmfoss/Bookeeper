<html xmlns = "http://www.w3.org/1999/xhtml">

  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title> ISP Term Project</title>
  </head>
  <body>
    <div id="title"> <h1 align="center"> Upload </h1> </div>
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
    <p>Use the radio buttons to select your answer to each question</p>
    <p>
    <%@page import="java.sql.*"%>
    <%
          String qs;
          String testName = request.getParameter("TestNames");
          String studentid = request.getParameter("id");
          Statement stmt;
          Connection con;
          ResultSet rs;
          String error;
          int q = 1;

          Class.forName("com.mysql.jdbc.Driver").newInstance();
          try {
            con = DriverManager.getConnection("jdbc:mysql://db1.cs.uakron.edu:3306/ISP_jms590","jms590","Seattle2");
            stmt = con.createStatement(); // SQL statement object

            qs="select * from " + testName;
            rs=stmt.executeQuery(qs);

            out.println("<form action = 'postGrades.jsp' method = 'post'>");
            while(rs.next())
            {
              out.println(String.valueOf(q) + ": " + rs.getString("Question") + "<br>" + "<input type='radio' name='q"+ String.valueOf(q)+"' value='A' checked>"+ rs.getString("AnswerA")+ "<br><input type='radio' name='q"+ String.valueOf(q)+"' value='B'>"+ rs.getString("AnswerB")+ "<br><input type='radio' name='q"+ String.valueOf(q)+"' value='C'>" + rs.getString("AnswerC") + "<br><input type='radio' name='q"+ String.valueOf(q)+"' value='D'>" + rs.getString("AnswerD") + "<br>");
              ++q;
            }
            out.println("<input type='hidden' name='test' value ='" + testName + "'>");
            out.println("<input type='hidden' name='studentid' value ='" + studentid + "'>");
            out.println("<input type='submit' value = 'submit'>");
            out.println("</form>");


          }
          catch (Exception e) {
          out.println(e.toString());  // Error message to display
          }
    %>
  </body>
</html>
