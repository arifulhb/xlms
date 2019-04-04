import hljs from 'highlight.js';
import 'highlight.js/styles/vs2015.css'

$(document).ready(function() {
  $('.highlight').each(function(i, block) {
    hljs.highlightBlock(block)
  })
})