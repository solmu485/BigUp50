<?php
    echo '    <link rel="stylesheet" href="Styles/style_ranking.css">
        <h1>Top Players</h1>
          <select id="playerCount">
          <option value="10">Top 10 Players</option>
          <option value="20">Top 20 Players</option>
          <option value="30">Top 30 Players</option>
          <option value="40">Top 40 Players</option>
          <option value="50" selected>Top 50 Players</option>
          </select>
    
        <div id="flags">
            <img id="DE" src="https://flagsapi.com/DE/flat/64.png" alt="Germany Flag" class="flag">
            <img id="LU" src="https://flagsapi.com/LU/flat/64.png" alt="Luxembourg Flag" class="flag">
            <img id="BE" src="https://flagsapi.com/BE/flat/64.png" alt="Belgium Flag" class="flag">
            <img id="FR" src="https://flagsapi.com/FR/flat/64.png" alt="France Flag" class="flag">
            <img id="NL" src="https://flagsapi.com/NL/flat/64.png" alt="Netherlands Flag" class="flag">
    
    
        </div>
    
        <div id="countryInfo"></div>
    
        <script src="Front-End/front_end_ranking.js"></script>
    '

?>


