<script>
    $(document).ready(function(e){

        $(document).on('change','.quiz-answer',function(e){
            e.preventDefault();
            let quiz_id = $(this).data('quiz_id');
            let choose_answer = $(this).val();
            let answer_block = '#answer_block_'+quiz_id;
            let show_answer = '.show-answer-'+quiz_id;
            let error_answer = '.error-answer-'+quiz_id;

            $.ajax({
                url:"{{ route('quiz.answer.check') }}",
                method:'GET',
                data:{quiz_id:quiz_id,choose_answer:choose_answer},
                success:function(res){
                    if(res.status == 'success'){
                        $(answer_block).css({'display':'block','background': 'whitesmoke',
                        'padding': '10px'});
                        $(error_answer).html('<span style="font-size:20px;">'+'Your Answer is:'+'</span>');
                        $(show_answer).html('<span style="color:green;font-size:20px;">' + 'Correct' +'</span>');
                    }
                    if(res.status == 'wrong'){
                        $(answer_block).css({'display':'block','background': 'whitesmoke',
                            'padding': '10px'});
                        $(error_answer).html('<span style="color:red;font-size:20px;">' + 'Wrong Answer' +'</span>');
                        $(show_answer).text('Correct Answer : ' + res.correct_answer);
                    }
                }
            });
        });

    });

</script>
