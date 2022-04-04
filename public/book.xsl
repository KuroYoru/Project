<?xml version="1.0" encoding="UTF-8"?>

<!--

-->

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <head>
                <title>Book List</title>
            </head>
            <body>
                <h1>Book List</h1>
                <hr />
                <table border="1">
                    <tr bgcolor="#9acd32">
                        <th>ID</th>
                        <th>Book Code</th>
                        <th>Book Name</th>
                        <th>Book Description</th>
                        <th>Book Privilege</th>
                        <th>User ID</th>
                        <th>Created At</th>
                        <th>Updated At</th>

                    </tr>
                    <xsl:for-each select="books/book">


                        <tr>
                            <td>
                                <xsl:value-of select="id"/>
                            </td>
                            <td>
                                <xsl:value-of select="bookCode"/>
                            </td>
                            <td>
                                <xsl:value-of select="bookName"/>
                            </td>
                            <td>
                                <xsl:value-of select="bookDesc"/>
                            </td>
                            <td>
                                <xsl:value-of select="bookPrivilege"/>
                            </td>
                            <td>
                                <xsl:value-of select="userID"/>
                            </td>
                            <td>
                                <xsl:value-of select="created_at"/>
                            </td>
                            <td>
                                <xsl:value-of select="updated_at"/>
                            </td>

                        </tr>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
