<template>
  <v-layout row>
    <v-flex xs12 sm6 offset-sm3>
      <v-card class="chat-card" dark="">
        <v-list>
          <v-subheader
            >
              Group Chat
            </v-subheader>
            <v-divider></v-divider>
            <v-list-tile
              class="p-3"
              v-for="(message, index) in allMessages" 
              :key="index"
            >




              <div class="message-wrapper">
                <v-flex>
                    <span class="small font-italic">{{message.user.name}}</span>
                </v-flex>


                <div v-if="message.message" class="text-message-container">
                    <v-chip color="green" text-color="white">
                        {{message.message}}
                    </v-chip>
                </div>

                <div class="image-container">
                    <img v-if="message.image"  :src="'/images/'+message.image" alt="" width="80">
                    
                </div>

                <v-flex class="caption font-italic">
                    {{message.created_at}}
                </v-flex>
              </div>





            </v-list-tile>
        </v-list>
      </v-card>

    </v-flex>

      <v-footer
      height="auto"
      fixed
      color="grey"
      >
      <v-layout row >



<!-- For upload file -->

<!-- f$refs.upload.active = true"    will automatically send photo -->
        <v-flex xs1 class="text-center">
             <file-upload
             post-action="/messages"
             ref='upload'
             @input-file="$refs.upload.active = true"
             :headers="{'X-CSRF-TOKEN': token}"
             >
                 <v-icon class="mt-3">attach_file</v-icon>
             </file-upload>

        </v-flex>

<!-- End upload file -->







        <v-flex xs6 offset-xs3 justify-center align-center>
            <v-text-field
              rows=2
              v-model="message"
              label="Enter Message"
              single-line
              @keyup.enter="sendMessage"
            ></v-text-field>
        </v-flex>

        <v-flex xs2> 
            <v-btn 
              @click="sendMessage"
             dark class="mt-3 ml-2 white--text" small color="green">send</v-btn>
        </v-flex>
      </v-layout>


    </v-footer>
  </v-layout>
</template>

<script>
  export default {
    props:['user'],
    
    data () {
      return {
        message:null,
        allMessages:[],
        token:document.head.querySelector('meta[name="csrf-token"]').content,
      }
    },
    methods:{
      sendMessage(){
        //check if there message
        if(!this.message){
          return alert('Please enter message');
        }
          axios.post('/messages', {message: this.message}).then(response => {
                    this.message=null;
                    this.allMessages.push(response.data.message)
                    setTimeout(this.scrollToEnd,100);
          });
      },
      fetchMessages() {
            axios.get('/messages').then(response => {
                this.allMessages = response.data;
            });
        },
      scrollToEnd(){
        window.scrollTo(0,99999);
      }
    
    },
    mounted(){
    },
    created(){
      this.fetchMessages();

      Echo.private('chatapp')
      .listen('MessageSent',(e)=>{
          this.allMessages.push(e.message)
          setTimeout(this.scrollToEnd,100);
      });
    }
    
  }
</script>

<style scoped>
.chat-card{
  margin-bottom:140px;
}
.floating-div{
    position: fixed;
}
.chat-card img {
    max-width: 300px;
    max-height: 200px;
}
</style>