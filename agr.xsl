<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:fo="http://www.w3.org/1999/XSL/Format">

    <xsl:template match="/">
        <html>
            <body>
                <table>
                    <tr>
                        <td><strong>Id</strong></td>
                        <td><strong>Firm</strong></td>
                        <td><strong>Client</strong></td>
                        <td><strong>Sum</strong></td>
                    </tr>
                    <xsl:apply-templates/>
                </table>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="agreement">
        <tr>
            <td><xsl:value-of select="@id"/></td>
            <xsl:apply-templates/>
        </tr>
    </xsl:template>
    <xsl:template match="firm|client|sum">
        <td>
            <xsl:value-of select="."/>
        </td>
    </xsl:template>

</xsl:stylesheet>