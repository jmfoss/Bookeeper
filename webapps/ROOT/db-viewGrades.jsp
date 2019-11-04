<html xmlns = "http://www.w3.org/1999/xhtml">

  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title> ISP Term Project</title>
  </head>
  <body>
    <div id="title"> <h1 align="center"> View Grades </h1> </div>
    <div class="topnav" id="myTopnav">
      <a href="prj.html"> Home </a>
      <a href="main.html">Create a Test</a>
      <a href="selectTest.jsp">Take Test</a>
      <a href="viewGrades.html" class="active">View Grades</a>
      <%-- <a href="uploadDoc.html">Upload Documents</a> --%>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
    </div>
    <p>

<%@page import="java.sql.*"%>

<%
		// Declare needed variables
		Connection con;
		DatabaseMetaData md;
		String qs;
		Statement stmt;
		ResultSet rs;
		out.println("\n <br>");

        // Other variables
        String id = request.getParameter("id");
        String quiz = request.getParameter("quiz");
        String grade = request.getParameter("grade");
        String action = request.getParameter("action");


		// Load DiverManager
		Class.forName("com.mysql.jdbc.Driver").newInstance();
		//Class.forName("com.microsoft.jdbc.sqlserver.SQLServerDriver");
		//out.println("Connecting ...\n <br>");

		try {

		// Open Database connection
		con = DriverManager.getConnection("jdbc:mysql://db1.cs.uakron.edu:3306/ISP_jms590","jms590","Seattle2");
		//out.println("Connection established.\n <br>");

		stmt = con.createStatement(); // SQL statement object

        // Display table
        if (action.equals("display")) {
        }

        // Insert data
        else if (action.equals("insert")) {
            qs="insert into id"+id+" (QuizName, Grade) values ('"+quiz+"', " +grade+ ")";
            stmt.executeUpdate(qs);
        }

        // Update Data
        else if (action.equals("update")) {
            qs= "update id"+id+" set Grade = "+grade+" where QuizName = '" + quiz+"'";
            stmt.executeUpdate(qs);
        }

        // Delete data
        else if (action.equals("delete")) {
            qs= "delete from id"+id+" where QuizName = '" + quiz+ "'" ;
            stmt.executeUpdate(qs);
        }

		//Query the data
		qs="select * from id"+id;
		rs=stmt.executeQuery(qs);

		//Show results
    out.println("<table style = 'border: 1px solid black; text-align: center; margin-left: 50px'> <caption> <h2> Grades for "+id+" </h2> </caption>");
		out.println("<tr style='font-weight: bold'> <td style = 'width: 100px; border:1px solid black'> Quiz Name </td> <td style = 'width: 100px;border:1px solid black'> Grade (%) </td> </tr>");

		while(rs.next())
		{
        out.println("<tr>"+"<td style = 'border:1px solid black'>" +rs.getString("QuizName")+"</td>" + "<td style = 'border:1px solid black'>" +rs.getString("Grade")+"</td></tr>");
		}
        out.println("</table>");
		rs.close();
		}

		catch (Exception e) {
		out.println(e.toString());  // Error message to display
		}

	%>

</body>
</html>
