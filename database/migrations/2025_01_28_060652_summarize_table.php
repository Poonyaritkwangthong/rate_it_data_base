<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('indicator', function (Blueprint $table) {
            $table->id();
            $table->string('indicator_name');//ชื่อผู้ถูกประเมิน
            $table->integer('main_question_num')->nullable();//ทำถาม
            $table->integer('other_question_num')->nullable();//ทำถาม
            $table->enum('indicator_status',['on','off'])->default('on');//คะเเนนทุกช้อ
            $table->timestamps();
        });

        Schema::create('summarize_part_01', function (Blueprint $table) {
            //เก็บข้อมมูลส่วนที่ 1 เเละ 2
            $table->id();
            $table->integer('personal_num');//ชื่อผู้ถูกประเมิน
            $table->text('evaluation_component_num');//ชื่อผู้ถูกประเมิน
            $table->text('points');//ชืคะเเนน
            $table->text('points_multiply');//คะเเนนที่คูณเเล้ว
            $table->integer('total_points');//รวมคะเเนนที่คูณเเล้ว
            $table->integer('criterion_num');//หมายเลขเกณฑ์
            $table->integer('evaluator_num');//หมายเลขผู้ประเมิน
            $table->integer('round')->nullable();//รอบที่ทำ
            $table->timestamps();
        });

        Schema::create('summarize_part_02', function (Blueprint $table) {
             //เก็บข้อมมูลส่วนที่ 3
            $table->id();
            $table->integer('personal_num');//ชื่อผู้ถูกประเมิน
            $table->text('skill_to_dev');//ทักษะที่ต้องพัฒนา
            $table->text('dev_method');//วิธีการพัฒนา
            $table->text('dev_time');//เวลาที่ใช้ในการพัฒนา
            $table->integer('evaluator_num');//หมายเลขผู้ประเมิน
            $table->integer('round')->nullable();//รอบที่ทำ
            $table->timestamps();
        });

        Schema::create('summarize_part_03', function (Blueprint $table) {
             //เก็บข้อมมูลส่วนที่ 4
            $table->id();
            $table->integer('personal_num')->nullable();//ชื่อผู้ถูกประเมิน
            $table->string('personal_signature')->nullable();//ชื่อผู้ถูกประเมิน
            $table->date('personal_date')->nullable();//วิธีการพัฒนา
            $table->text('assessment_acknowledgement_num')->nullable();//เเจ้งผลการประเมินเเละผู้รับประเมินรับทราบ
            $table->date('on_the_date')->nullable();//วิธีการพัฒนา
            $table->date('evaluation_date')->nullable();//วิธีการพัฒนา
            $table->integer('witness_num')->nullable();
            $table->string('witness_signature')->nullable();
            $table->date('witness_date')->nullable();
            $table->integer('evaluator_num')->nullable();//หมายเลขผู้ประเมิน
            $table->string('evaluator_signature')->nullable();//หมายเลขผู้ประเมิน
            $table->integer('round')->nullable();//รอบที่ทำ
            $table->timestamps();
        });

        Schema::create('above_comments', function (Blueprint $table) {
             //เก็บข้อมมูลส่วนที่ 5
            $table->id();
            $table->integer('personal_num')->nullable();//ชื่อผู้ถูกประเมิน
            $table->integer('above_comment_num')->nullable();//ความคิดเห็นของผู้บัญชาปกติ
            $table->string('above_comment_detail')->nullable();//รายละเอียดความคิดเห็นของผู้บัญชาปกติ
            $table->integer('above_num')->nullable();//หมายเลขผู้บัญชาปกติ
            $table->string('above_signature')->nullable();//ลายเซ็นผู้บัญชาปกติ
            $table->integer('round')->nullable();//รอบที่ทำ
            $table->timestamps();
        });

        Schema::create('further_comments', function (Blueprint $table) {
             //เก็บข้อมมูลส่วนที่ 5
            $table->id();
            $table->integer('personal_num')->nullable();//ชื่อผู้ถูกประเมิน
            $table->integer('further_comment_num')->nullable();//ความคิดเห็นของผู้บัญชาเหนือขึ้นไป
            $table->string('further_comment_detail')->nullable();//รายละเอียดความคิดเห็นของผู้บัญชาเหนือขึ้นไป
            $table->integer('further_num')->nullable();//หมายเลขของผู้บัญชาเหนือขึ้นไป
            $table->string('further_signature')->nullable();//ลายเซ็นของผู้บัญชาเหนือขึ้นไป
            $table->integer('round')->nullable();//รอบที่ทำ
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('indicator');//ตัวอย่าง!!
        Schema::dropIfExists('summarize_part_01');//ตัวอย่าง!!
        Schema::dropIfExists('summarize_part_02');//ตัวอย่าง!!
        Schema::dropIfExists('summarize_part_03');//ตัวอย่าง!!
        Schema::dropIfExists('above_comments');//ตัวอย่าง!!
        Schema::dropIfExists('further_comments');//ตัวอย่าง!!
    }
};
