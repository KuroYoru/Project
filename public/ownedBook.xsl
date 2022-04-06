<?xml version="1.0" encoding="UTF-8"?>

<!--

-->

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            

            <head>
                <title>Owned Book List</title>
                
            </head>
            <body>
                <h1>Owned Book List</h1>
                <hr />
                <table border="1">
                    <tr bgcolor="#9acd32">
                        <th>User ID</th>
                        <th>Book ID</th>
                    </tr>
                    <xsl:for-each select="ownedbooks/ownedbook">
                        <tr>
                            <td>
                                <xsl:value-of select="userID"/>
                            </td>
                            <td>
                                <xsl:value-of select="bookID"/>
                            </td>
                        </tr>
                    </xsl:for-each>
                    
                </table>
                <br></br>
                <tr>
                        <a href="books" class="btn btn-warning">Back</a>
                </tr>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
