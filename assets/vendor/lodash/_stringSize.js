var asciiSize=require("./_asciiSize"),hasUnicode=require("./_hasUnicode"),unicodeSize=require("./_unicodeSize");function stringSize(i){return hasUnicode(i)?unicodeSize(i):asciiSize(i)}module.exports=stringSize;