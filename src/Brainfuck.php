<?php

class Brainfuck {
    /**
     * @var string
     */
    public $code = '';

    /**
     * @var string
     */
    public $input = '';

    /**
     * @var int
     */
    public $input_pointer = 0;

    /**
     * @var int
     */
    public $instruction_pointer = 0;

    /**
     * @var int
     */
    public $data_pointer = 0;

    /**
     * @var array
     */
    public $cells = [];

    /**
     * Set up.
     *
     * @param $code
     * @param string $input
     */
    public function setup($code, $input = '') {
        $this->code  = $code;
        $this->input = $input;

        $this->cells = array_fill(0, 30000, 0);
    }

    /**
     * Run the program from the current state.
     */
    public function run() {
        while($this->instruction_pointer < strlen($this->code)) {
           $this->interpret($this->code[$this->instruction_pointer]);
        }
    }

    /**
     * Interpret a single command.
     *
     * @param $command
     */
    protected function interpret($command) {
        switch($command) {
            case '>':
                $this->data_pointer++;

                break;
            case '<':
                $this->data_pointer--;

                break;
            case '+':
                if($this->cells[$this->data_pointer] === 255) {
                    $this->cells[$this->data_pointer] = 0;
                } else {
                    $this->cells[$this->data_pointer]++;
                }

                if(!isset($this->cells[$this->data_pointer])) {
                    die("End of memory reached.\n");
                }

                break;
            case '-':
                if($this->cells[$this->data_pointer] === 0) {
                    $this->cells[$this->data_pointer] = 255;
                } else {
                    $this->cells[$this->data_pointer]--;
                }

                if(!isset($this->cells[$this->data_pointer])) {
                    die("End of memory reached.\n");
                }

                break;
            case '.':
                echo chr($this->cells[$this->data_pointer]);

                break;
            case ',':
                if(!isset($this->input[$this->input_pointer - 1])) {
                    die("\nEnd of input reached\n");
                } else if(isset($this->input[$this->input_pointer])) {
                    $this->cells[$this->data_pointer] = ord($this->input[$this->input_pointer]);
                }

                $this->input_pointer++;

                break;
            case '[':
                if($this->cells[$this->data_pointer] === 0) {
                    $this->movePointerToMatchingClosingBrace();
                }

                break;
            case ']':
                if($this->cells[$this->data_pointer] !== 0) {
                    $this->movePointerToMatchingOpenBrace();
                }

                break;
        }

        $this->instruction_pointer++;
    }

    protected function movePointerToMatchingOpenBrace() {
        $close_brace_count = 1;

        while($close_brace_count > 0) {
            $this->instruction_pointer--;

            if($this->code[$this->instruction_pointer] === '[') {
                $close_brace_count--;
            } else if($this->code[$this->instruction_pointer] === ']') {
                $close_brace_count++;
            }
        }
    }

    protected function movePointerToMatchingClosingBrace() {
        $open_brace_count = 1;

        while($open_brace_count > 0) {
            $this->instruction_pointer++;

            if($this->code[$this->instruction_pointer] === '[') {
                $open_brace_count++;
            } else if($this->code[$this->instruction_pointer] === ']') {
                $open_brace_count--;
            }
        }
    }
}