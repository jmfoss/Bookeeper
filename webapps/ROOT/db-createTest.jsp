<html xmlns = "http://www.w3.org/1999/xhtml">

  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title> ISP Term Project</title>
  </head>
  <body>
    <div id="title"> <h1 align="center"> Upload </h1> </div>
    <div class="topnav" id="myTopnav">
      <a href="prj.html"> Home </a>
      <a href="main.html" class="active">Create a Test</a>
      <a href="selectTest.jsp">Take Test</a>
      <a href="viewGrades.html">View Grades</a>
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
		String name = request.getParameter("testName");
    String question = request.getParameter("question");
    String a1 = request.getParameter("qA");
    String a2 = request.getParameter("qB");
		String a3 = request.getParameter("qC");
		String a4 = request.getParameter("qD");
		String answer = request.getParameter("answer");


		// Load DiverManager
		Class.forName("com.mysql.jdbc.Driver").newInstance();
		//Class.forName("com.microsoft.jdbc.sqlserver.SQLServerDriver");
		//out.println("Connecting ...\n <br>");

		try {

		// Open Database connection
		con = DriverManager.getConnection("jdbc:mysql://db1.cs.uakron.edu:3306/ISP_jms590","jms590","Seattle2");
		//out.println("Connection established.\n <br>");

		stmt = con.createStatement(); // SQL statement object

		// Set variables to blank if no input
		if (question.equals("")) {question = "N/A";}
		if (a1.equals("")) {a1 = "N/A";}
		if (a2.equals("")) {a2 = "N/A";}
		if (a3.equals("")) {a3 = "N/A";}
		if (a4.equals("")) {a4 = "N/A";}
		if (answer.equals("")) {a1 = "N";}

		// Check if table exists
		DatabaseMetaData dbm = con.getMetaData();
		ResultSet tables = dbm.getTables(null, null, name, null);
		if (tables.next()) {
		  // Table exists
			qs="insert into "+name+" (Question, AnswerA, AnswerB, AnswerC, AnswerD, Answer) values ('"+question+"', '" +a1+ "','"+a2+"','"+a3+"','"+a4+"','"+answer+"')";
			stmt.executeUpdate(qs);
				//out.println(qs);

		}
		else {
		  // Table does not exist
			qs="create table " +name+" (Question varchar(100), AnswerA varchar(100), AnswerB varchar(100), AnswerC varchar(100), AnswerD varchar(100), Answer varchar(1))";
			stmt.executeUpdate(qs);
				//out.println("Table created.\n <br>");

			qs="insert into TestNames (TestName) values ('"+name+"')";
			stmt.executeUpdate(qs);
				//out.println(qs);

			qs="insert into "+name+" (Question, AnswerA, AnswerB, AnswerC, AnswerD, Answer) values ('"+question+"', '" +a1+ "','"+a2+"','"+a3+"','"+a4+"','"+answer+"')";
			stmt.executeUpdate(qs);
				//out.println(qs);
		}

		//Query the data
		qs="select * from " + name;
		rs=stmt.executeQuery(qs);


		//Show results
		out.println("</br> </br> <p style='margin-left:50px'> Press back to return to the previous page and add another question. </p> </br>");
    out.println("<table style = 'border: 1px solid black; text-align: center; margin-left:50px'> <caption> <h2> "+name+" </h2> </caption>");
		out.println("<tr style ='font-weight: bold'> <td style = 'width: 100px; border:1px solid black'> Question </td> <td style = 'width: 100px;border:1px solid black'> Answer A </td> <td style = 'width: 100px;border:1px solid black'> Answer B </td> <td style = 'width: 100px;border:1px solid black'> Answer C </td> <td style = 'width: 100px;border:1px solid black'> Answer D </td> <td style = 'width: 100px;border:1px solid black'> Answer</td></tr>");

		while(rs.next())
		{
			out.println("<tr>"+"<td style = 'border:1px solid black'>" +rs.getString("Question")+"</td>" + "<td style = 'border:1px solid black'>" +rs.getString("AnswerA")+"</td>" + "<td style = 'border:1px solid black'>"+rs.getString("AnswerB")+"</td>" + "<td style = 'border:1px solid black'>"+rs.getString("AnswerC")+"</td>" + "<td style = 'border:1px solid black'>"+rs.getString("AnswerD")+"</td>" + "<td style = 'border:1px solid black'>"+rs.getString("Answer")+"</td>"+"</tr>");
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
