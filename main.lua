local http = require("socket.http")
local ltn12 = require("ltn12")
local json = require("json")
local query = "id=1&game=3&score=100"
local query2 = "id=1&game=2&score=100"
serverUrl = "http://mygame.com/index.php/savescore/"
local responseBody = {}

local getHTTP = serverUrl .. "?" .. query
print( getHTTP )

print( "GET ----")
-- GET request. There is no second body paramater
local body, code, headers = http.request( getHTTP )
local asJsonG = json.decode(body)

table.foreach(asJsonG, print)

print( "POST ----")
-- POST request.
local b, c, h = http.request( serverUrl, query2 )
local asJsonP = json.decode(b)

print (b)
table.foreach(asJsonP, print)
